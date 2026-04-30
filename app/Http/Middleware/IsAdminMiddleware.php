<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next): Response
{
    $role_id = session()->get('role_id');

    if (in_array($role_id, [4, 6])) { // ✅ admin + dsa
        return $next($request);
    }

    return redirect()->route('login')
        ->with('error', 'You are not authorized');
}
}
