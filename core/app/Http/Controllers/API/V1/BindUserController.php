<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\MbtBindUser;
use App\Binduser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BindUserController extends Controller
{
    use ApiResponse;

    /**
     * Get all bound users/accounts for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            // Get bind user info if user has bind_user_id
            $bindUsers = [];
            
            if ($user->bind_user_id) {
                $mbtBindUser = MbtBindUser::find($user->bind_user_id);
                if ($mbtBindUser) {
                    $bindUsers[] = $this->formatBindUser($mbtBindUser);
                }
            }
            
            // Also get from bind_history table
            $bindHistory = Binduser::where('user_id', $user->id)->get();
            foreach ($bindHistory as $bind) {
                $mbtUser = MbtBindUser::find($bind->bind_user_id);
                if ($mbtUser) {
                    $formatted = $this->formatBindUser($mbtUser);
                    $formatted['bind_id'] = $bind->id;
                    $bindUsers[] = $formatted;
                }
            }

            return $this->successResponse([
                'bind_users' => $bindUsers,
                'count' => count($bindUsers)
            ], 'Bound users retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Get bind users failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Failed to retrieve bound users.');
        }
    }

    /**
     * Get details of a specific bound user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            // Verify user has access to this bind user
            $mbtBindUser = MbtBindUser::find($id);
            
            if (!$mbtBindUser) {
                return $this->notFoundResponse('Bound user not found.');
            }
            
            // Check if user owns this binding
            if ($user->bind_user_id != $id) {
                $bindRecord = Binduser::where('user_id', $user->id)
                    ->where('bind_user_id', $id)
                    ->first();
                    
                if (!$bindRecord) {
                    return $this->forbiddenResponse('You do not have access to this account.');
                }
            }

            return $this->successResponse([
                'bind_user' => $this->formatBindUserDetailed($mbtBindUser)
            ], 'Bound user details retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Get bind user details failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Failed to retrieve bound user details.');
        }
    }

    /**
     * Bind a new broadband account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_id' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors()->toArray());
        }

        try {
            $user = $request->user();
            
            // Find the MBT user by account ID (user_id field in mbt_bind_user)
            $mbtUser = MbtBindUser::where('user_id', $request->account_id)->first();
            
            if (!$mbtUser) {
                return $this->errorResponse('Account not found. Please check your account ID.', 404);
            }
            
            // Verify password
            if ($mbtUser->password !== $request->password) {
                return $this->errorResponse('Invalid password.', 401);
            }
            
            // Check if already bound
            $existingBind = Binduser::where('user_id', $user->id)
                ->where('bind_user_id', $mbtUser->id)
                ->first();
                
            if ($existingBind || $user->bind_user_id == $mbtUser->id) {
                return $this->errorResponse('This account is already bound to your profile.', 400);
            }
            
            // Create binding record
            $bind = Binduser::create([
                'user_id' => $user->id,
                'bind_user_id' => $mbtUser->id,
                'bind_status' => 1,
            ]);
            
            // Update user's primary bind_user_id if not set
            if (!$user->bind_user_id) {
                $user->update(['bind_user_id' => $mbtUser->id]);
            }

            return $this->successResponse([
                'bind_user' => $this->formatBindUser($mbtUser),
                'bind_id' => $bind->id
            ], 'Account bound successfully', 201);
        } catch (\Exception $e) {
            Log::error('Bind user failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Failed to bind account.');
        }
    }

    /**
     * Unbind a broadband account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            // Find the binding
            $bind = Binduser::where('user_id', $user->id)
                ->where('id', $id)
                ->first();
                
            if (!$bind) {
                return $this->notFoundResponse('Binding not found.');
            }
            
            // If this was the primary bind, clear it
            if ($user->bind_user_id == $bind->bind_user_id) {
                $user->update(['bind_user_id' => null]);
            }
            
            $bind->delete();

            return $this->successResponse(null, 'Account unbound successfully');
        } catch (\Exception $e) {
            Log::error('Unbind user failed: ' . $e->getMessage());
            return $this->serverErrorResponse('Failed to unbind account.');
        }
    }

    /**
     * Format bind user data for API response.
     */
    protected function formatBindUser($mbtUser): array
    {
        return [
            'id' => $mbtUser->id,
            'account_id' => $mbtUser->user_id,
            'user_name' => $mbtUser->user_name,
            'real_name' => $mbtUser->user_real_name,
            'phone' => $mbtUser->phone ?? $mbtUser->Phone_number,
            'address' => $mbtUser->user_address,
            'package' => $mbtUser->Now_package ?? null,
            'monthly_cost' => $mbtUser->Monthly_Cost,
            'expire_time' => $mbtUser->user_expire_time,
            'status' => $mbtUser->user_status_mbt,
            'balance' => $mbtUser->balance,
        ];
    }

    /**
     * Format detailed bind user data for API response.
     */
    protected function formatBindUserDetailed($mbtUser): array
    {
        return array_merge($this->formatBindUser($mbtUser), [
            'email' => $mbtUser->email,
            'area' => $mbtUser->Area,
            'bandwidth' => $mbtUser->Bandwidth,
            'service_type' => $mbtUser->Service_type,
            'installation_date' => $mbtUser->Installation_date,
            'start_time' => $mbtUser->user_start_time,
            'create_time' => $mbtUser->user_create_time,
            'router_type' => $mbtUser->Router_type,
            'sub_company' => $mbtUser->Sub_company,
            'gps' => $mbtUser->GPS,
            'last_online' => $mbtUser->last_online,
            'last_offline' => $mbtUser->last_offline,
        ]);
    }
}
