<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPartnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $roleId = (int) auth()->user()->role_id;

        // allow partner (3) and admin (4) if needed
        if ($roleId === 3 || $roleId === 4) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
