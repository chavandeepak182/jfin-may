<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDsaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = session()->get('role_id');

        if (
            $role_id == config('constants.roles.dsa') ||
            $role_id == config('constants.roles.admin')
        ) {
            return $next($request);
        }

        return redirect()->route('login')
            ->with('error', 'Unauthorized');
    }
}