<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
{
    $role_id = session()->get('role_id');

    if (in_array($role_id, [1,2,3,4,6])) {
        return $next($request);
    }

    return redirect('/')
        ->with('error','You are not authorized to access this page');
}
}
