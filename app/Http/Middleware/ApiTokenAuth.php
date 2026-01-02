<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 0,
                'message' => 'Authorization token missing'
            ], 401);
        }

        // token was stored HASHED during login
        $hashedToken = hash('sha256', $token);

        $user = User::where('api_token', $hashedToken)->first();

        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid token'
            ], 401);
        }

        // 🔥 THIS LINE IS THE HEART OF EVERYTHING
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
