<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if ($request->is('properties') || $request->is('property/*')) {
                return route('property.login');
            }

            return route('authv3.login.form');
        }
    }
}
