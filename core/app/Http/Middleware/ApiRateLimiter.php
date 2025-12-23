<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiRateLimiter
{
    /**
     * Rate limit configurations for different endpoint types.
     * Format: [max_attempts, decay_minutes]
     */
    protected $limits = [
        // Authentication endpoints (stricter limits to prevent brute force)
        'auth' => [
            'login' => [5, 1],           // 5 attempts per minute
            'register' => [3, 1],        // 3 attempts per minute
            'forgot-password' => [3, 5], // 3 attempts per 5 minutes
            'reset-password' => [5, 5],  // 5 attempts per 5 minutes
        ],
        
        // General API endpoints
        'api' => [
            'default' => [60, 1],        // 60 requests per minute
            'write' => [30, 1],          // 30 write operations per minute
            'read' => [120, 1],          // 120 read operations per minute
        ],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type  Rate limit type: auth, api, write, read
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $type = 'default')
    {
        $key = $this->resolveRequestSignature($request, $type);
        $limits = $this->getLimits($request, $type);
        
        $maxAttempts = $limits[0];
        $decayMinutes = $limits[1];
        
        $currentAttempts = Cache::get($key, 0);
        
        if ($currentAttempts >= $maxAttempts) {
            $retryAfter = Cache::get($key . ':timer', 0) - time();
            $retryAfter = max($retryAfter, 1);
            
            Log::warning('Rate limit exceeded', [
                'ip' => $request->ip(),
                'path' => $request->path(),
                'type' => $type,
                'attempts' => $currentAttempts,
            ]);
            
            return response()->json([
                'success' => false,
                'status' => 429,
                'message' => 'Too many requests. Please try again later.',
                'data' => [
                    'retry_after' => $retryAfter,
                    'limit' => $maxAttempts,
                    'remaining' => 0,
                ]
            ], 429, [
                'Retry-After' => $retryAfter,
                'X-RateLimit-Limit' => $maxAttempts,
                'X-RateLimit-Remaining' => 0,
                'X-RateLimit-Reset' => Cache::get($key . ':timer', time() + ($decayMinutes * 60)),
            ]);
        }
        
        // Increment attempts
        $this->incrementAttempts($key, $decayMinutes);
        
        $response = $next($request);
        
        // Add rate limit headers to response
        $remaining = max(0, $maxAttempts - Cache::get($key, 0));
        
        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remaining,
            'X-RateLimit-Reset' => Cache::get($key . ':timer', time() + ($decayMinutes * 60)),
        ]);
    }

    /**
     * Resolve the request signature for rate limiting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return string
     */
    protected function resolveRequestSignature(Request $request, string $type): string
    {
        // Use user ID if authenticated, otherwise use IP
        $identifier = $request->user() 
            ? 'user:' . $request->user()->id 
            : 'ip:' . $request->ip();
        
        // Include endpoint for auth-specific limits
        if ($type === 'auth') {
            $endpoint = basename($request->path());
            return "rate_limit:{$type}:{$endpoint}:{$identifier}";
        }
        
        return "rate_limit:{$type}:{$identifier}";
    }

    /**
     * Get the rate limits for the request type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return array [max_attempts, decay_minutes]
     */
    protected function getLimits(Request $request, string $type): array
    {
        if ($type === 'auth') {
            $endpoint = basename($request->path());
            return $this->limits['auth'][$endpoint] ?? [10, 1];
        }
        
        if ($type === 'write') {
            return $this->limits['api']['write'];
        }
        
        if ($type === 'read') {
            return $this->limits['api']['read'];
        }
        
        return $this->limits['api']['default'];
    }

    /**
     * Increment the counter for the given key.
     *
     * @param  string  $key
     * @param  int  $decayMinutes
     * @return void
     */
    protected function incrementAttempts(string $key, int $decayMinutes): void
    {
        $expiresAt = now()->addMinutes($decayMinutes);
        
        if (!Cache::has($key)) {
            Cache::put($key, 1, $expiresAt);
            Cache::put($key . ':timer', $expiresAt->timestamp, $expiresAt);
        } else {
            Cache::increment($key);
        }
    }

    /**
     * Clear rate limit for a specific key (useful for successful login).
     *
     * @param  string  $identifier
     * @param  string  $type
     * @return void
     */
    public static function clear(string $identifier, string $type = 'auth'): void
    {
        $key = "rate_limit:{$type}:{$identifier}";
        Cache::forget($key);
        Cache::forget($key . ':timer');
    }
}
