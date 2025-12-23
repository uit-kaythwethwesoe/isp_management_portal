<?php

/*
|--------------------------------------------------------------------------
| API V1 Routes - Mobile App
|--------------------------------------------------------------------------
|
| Secure, well-structured API routes with proper authentication.
| All routes are prefixed with /api/v1/
|
| Base URL: https://isp.mlbbshop.app/api/v1
|
| Rate Limits:
| - Auth endpoints (login/register): 5 requests/minute
| - Forgot password: 3 requests/5 minutes
| - Read endpoints: 120 requests/minute
| - Write endpoints: 30 requests/minute
|
*/

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Strict Rate Limiting)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware('api.limit:auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset-password', 'AuthController@resetPassword');
});

/*
|--------------------------------------------------------------------------
| Public Routes (Read - Higher Limit)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware('api.limit:read')->group(function () {
    Route::get('packages', 'PackageController@index');
    Route::get('packages/{id}', 'PackageController@show');
    Route::get('banners', 'SystemController@banners');
    Route::get('maintenance-status', 'SystemController@maintenanceStatus');
    Route::get('app-version', 'SystemController@appVersion');
    Route::get('settings', 'SystemController@settings');
});

/*
|--------------------------------------------------------------------------
| Protected Read Routes (Authentication + Read Rate Limit)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware(['auth.api', 'api.limit:read'])->group(function () {
    // Profile
    Route::get('profile', 'AuthController@profile');
    
    // Bind Users
    Route::get('bind-users', 'BindUserController@index');
    Route::get('bind-users/{id}', 'BindUserController@show');
    
    // Packages
    Route::get('my-packages', 'PackageController@myPackages');
    
    // Payments
    Route::get('payments', 'PaymentController@index');
    Route::get('payments/methods', 'PaymentController@methods');
    Route::get('payments/{id}', 'PaymentController@show');
    Route::get('payments/{id}/status', 'PaymentController@status');
    
    // Notifications
    Route::get('notifications', 'NotificationController@index');
    Route::get('notifications/unread-count', 'NotificationController@unreadCount');
    Route::get('notifications/{id}', 'NotificationController@show');
    
    // Fault Reports
    Route::get('fault-reports', 'FaultReportController@index');
    Route::get('fault-reports/{id}', 'FaultReportController@show');
});

/*
|--------------------------------------------------------------------------
| Protected Write Routes (Authentication + Write Rate Limit)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware(['auth.api', 'api.limit:write'])->group(function () {
    // Auth Management
    Route::post('logout', 'AuthController@logout');
    Route::post('logout-all', 'AuthController@logoutAll');
    Route::post('refresh-token', 'AuthController@refreshToken');
    Route::post('change-password', 'AuthController@changePassword');
    Route::post('device-token', 'AuthController@updateDeviceToken');
    Route::delete('account', 'AuthController@deleteAccount');
    
    // Profile
    Route::put('profile', 'ProfileController@update');
    Route::post('profile/image', 'ProfileController@uploadImage');
    
    // Bind Users
    Route::post('bind-users', 'BindUserController@store');
    Route::delete('bind-users/{id}', 'BindUserController@destroy');
    
    // Payments
    Route::post('payments/initiate', 'PaymentController@initiate');
    
    // Notifications
    Route::put('notifications/{id}/read', 'NotificationController@markAsRead');
    Route::put('notifications/read-all', 'NotificationController@markAllAsRead');
    
    // Fault Reports
    Route::post('fault-reports', 'FaultReportController@store');
    Route::put('fault-reports/{id}', 'FaultReportController@update');
    Route::delete('fault-reports/{id}', 'FaultReportController@destroy');
});
