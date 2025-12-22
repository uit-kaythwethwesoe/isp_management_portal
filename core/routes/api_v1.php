<?php

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
|
| Secure, well-structured API routes with proper authentication.
| All routes are prefixed with /api/v1/
|
*/

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->group(function () {
    
    // Authentication
    Route::post('auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@login');
    
    // Public data
    Route::get('packages', 'PackageController@index');
    Route::get('banners', 'BannerController@index');
    Route::get('maintenance-status', 'SystemController@maintenanceStatus');
    Route::get('app-version', 'SystemController@appVersion');
    
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Authentication Required)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware('auth.api')->group(function () {
    
    // Auth management
    Route::post('auth/logout', 'AuthController@logout');
    Route::post('auth/logout-all', 'AuthController@logoutAll');
    Route::post('auth/refresh-token', 'AuthController@refreshToken');
    Route::post('auth/change-password', 'AuthController@changePassword');
    
    // User profile
    Route::get('profile', 'AuthController@profile');
    Route::put('profile', 'ProfileController@update');
    Route::post('profile/image', 'ProfileController@uploadImage');
    
    // Bind users / devices
    Route::get('bind-users', 'BindUserController@index');
    Route::post('bind-users', 'BindUserController@store');
    Route::delete('bind-users/{id}', 'BindUserController@destroy');
    
    // Payments
    Route::get('payments', 'PaymentController@index');
    Route::get('payments/{id}', 'PaymentController@show');
    Route::post('payments/initiate', 'PaymentController@initiate');
    Route::get('payments/{id}/status', 'PaymentController@status');
    
    // Packages & Services
    Route::get('my-packages', 'PackageController@myPackages');
    Route::get('packages/{id}', 'PackageController@show');
    
    // Notifications
    Route::get('notifications', 'NotificationController@index');
    Route::put('notifications/{id}/read', 'NotificationController@markAsRead');
    Route::put('notifications/read-all', 'NotificationController@markAllAsRead');
    
    // Support / Queries
    Route::get('queries', 'QueryController@index');
    Route::post('queries', 'QueryController@store');
    Route::get('queries/{id}', 'QueryController@show');
    
    // Messages / Chat
    Route::get('messages', 'MessageController@index');
    Route::post('messages', 'MessageController@store');
    
    // Fault reports
    Route::get('fault-reports', 'FaultReportController@index');
    Route::post('fault-reports', 'FaultReportController@store');
    
});

/*
|--------------------------------------------------------------------------
| Payment Callbacks (Special - No Auth but Verified by Gateway)
|--------------------------------------------------------------------------
*/
Route::prefix('v1/callbacks')->namespace('API\V1')->group(function () {
    Route::match(['GET', 'POST'], 'kbz', 'PaymentCallbackController@kbz');
    Route::match(['GET', 'POST'], 'wave', 'PaymentCallbackController@wave');
    Route::match(['GET', 'POST'], 'aya', 'PaymentCallbackController@aya');
    Route::match(['GET', 'POST'], 'cb', 'PaymentCallbackController@cb');
});
