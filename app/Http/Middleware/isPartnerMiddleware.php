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
       
        $role_id = session()->get('role_id');
       if( $role_id == env('partnerRole_id') || $role_id == 4 ){
        return $next($request);
       }
       return redirect('/')->with('error', 'You are not the authorized user to access this page');
        
    }
}
