<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStakeholderMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = session()->get('role_id');

        // ✅ Only stakeholder allowed
        if ($role_id == config('constants.roles.stakeholder')) {
            return $next($request);
        }

        return redirect()->route('login')
            ->with('error', 'You are not authorized');
    }
}