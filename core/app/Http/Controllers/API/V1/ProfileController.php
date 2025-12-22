<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;

    /**
     * Update user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'sometimes|string|min:2|max:100',
            'email' => 'sometimes|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors()->toArray());
        }

        try {
            $user = $request->user();
            
            $updateData = [];
            
            if ($request->has('name')) {
                $updateData['name'] = $request->name;
            }
            
            if ($request->has('email')) {
                $updateData['email'] = $request->email;
            }
            
            if (!empty($updateData)) {
                $user->update($updateData);
            }

            return $this->successResponse([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'profile_image' => $user->profile_image,
                ],
            ], 'Profile updated successfully');
            
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Profile update failed.');
        }
    }

    /**
     * Upload profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors()->toArray());
        }

        try {
            $user = $request->user();
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Store in public storage
                $path = $image->storeAs('profiles', $filename, 'public');
                
                // Delete old image if exists
                if ($user->profile_image) {
                    \Storage::disk('public')->delete($user->profile_image);
                }
                
                $user->update(['profile_image' => $path]);
                
                return $this->successResponse([
                    'profile_image' => asset('storage/' . $path),
                ], 'Profile image uploaded successfully');
            }
            
            return $this->errorResponse('No image provided', 400);
            
        } catch (\Exception $e) {
            \Log::error('Profile image upload failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Image upload failed.');
        }
    }
}
