<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'api/v1/*'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    'allowed_origins' => [
        // Add your mobile app domains here
        // For development, you might allow localhost
        // 'http://localhost:3000',
        // 'http://localhost:8080',
    ],

    'allowed_origins_patterns' => [
        // Allow all for development - RESTRICT IN PRODUCTION
        // '#^https?://.*$#',
    ],

    'allowed_headers' => [
        'Content-Type',
        'X-Requested-With',
        'Authorization',
        'Accept',
        'Origin',
        'X-Auth-Token',
    ],

    'exposed_headers' => [],

    'max_age' => 86400, // 24 hours

    'supports_credentials' => false,

];
