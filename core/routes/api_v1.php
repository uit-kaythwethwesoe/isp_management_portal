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
*/

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->group(function () {
    
    // Authentication
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    
    // Password Reset (Forgot Password)
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset-password', 'AuthController@resetPassword');
    
    // Public data
    Route::get('packages', 'PackageController@index');
    Route::get('packages/{id}', 'PackageController@show');
    Route::get('banners', 'SystemController@banners');
    
    // System
    Route::get('maintenance-status', 'SystemController@maintenanceStatus');
    Route::get('app-version', 'SystemController@appVersion');
    Route::get('settings', 'SystemController@settings');
    
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Authentication Required)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->namespace('API\V1')->middleware('auth.api')->group(function () {
    
    // ==================== Auth Management ====================
    Route::post('logout', 'AuthController@logout');
    Route::post('logout-all', 'AuthController@logoutAll');
    Route::post('refresh-token', 'AuthController@refreshToken');
    Route::post('change-password', 'AuthController@changePassword');
    Route::post('device-token', 'AuthController@updateDeviceToken');
    Route::delete('account', 'AuthController@deleteAccount');
    
    // ==================== User Profile ====================
    Route::get('profile', 'AuthController@profile');
    Route::put('profile', 'ProfileController@update');
    Route::post('profile/image', 'ProfileController@uploadImage');
    
    // ==================== Bind Users (Broadband Accounts) ====================
    Route::get('bind-users', 'BindUserController@index');
    Route::get('bind-users/{id}', 'BindUserController@show');
    Route::post('bind-users', 'BindUserController@store');
    Route::delete('bind-users/{id}', 'BindUserController@destroy');
    
    // ==================== Packages ====================
    Route::get('my-packages', 'PackageController@myPackages');
    
    // ==================== Payments ====================
    Route::get('payments', 'PaymentController@index');
    Route::get('payments/methods', 'PaymentController@methods');
    Route::get('payments/{id}', 'PaymentController@show');
    Route::post('payments/initiate', 'PaymentController@initiate');
    Route::get('payments/{id}/status', 'PaymentController@status');
    
    // ==================== Notifications ====================
    Route::get('notifications', 'NotificationController@index');
    Route::get('notifications/unread-count', 'NotificationController@unreadCount');
    Route::get('notifications/{id}', 'NotificationController@show');
    Route::put('notifications/{id}/read', 'NotificationController@markAsRead');
    Route::put('notifications/read-all', 'NotificationController@markAllAsRead');
    
    // ==================== Fault Reports ====================
    Route::get('fault-reports', 'FaultReportController@index');
    Route::get('fault-reports/{id}', 'FaultReportController@show');
    Route::post('fault-reports', 'FaultReportController@store');
    Route::put('fault-reports/{id}', 'FaultReportController@update');
    Route::delete('fault-reports/{id}', 'FaultReportController@destroy');
    
});
