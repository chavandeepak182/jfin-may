<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDsaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = session()->get('role_id');

        // ✅ Only DSA allowed
        if ($role_id == config('constants.roles.dsa')) {
            return $next($request);
        }

        return redirect()->route('login')
            ->with('error', 'You are not authorized');
    }
}