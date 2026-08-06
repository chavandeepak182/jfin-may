<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLeadReferralMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id == config('constants.roles.lead_referral')) {
            return $next($request);
        }

        abort(403,'Unauthorized');
    }
}