<?php

use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsAgentMiddleware;
use App\Http\Middleware\IsPartnerMiddleware;
use App\Http\Middleware\IsUserMiddleware;
use App\Http\Middleware\IsUserOrAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsStakeholderMiddleware;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'auth' => Authenticate::class, // 🔥 THIS NOW WORKS

        'isAdmin' => IsAdminMiddleware::class,
        'isAgent' => IsAgentMiddleware::class,
        'isPartner' => IsPartnerMiddleware::class,
        'isUser' => IsUserMiddleware::class,
        'isUserOrAdmin' => IsUserOrAdminMiddleware::class,
        // ✅ ADD THIS
    'isStakeholder' => IsStakeholderMiddleware::class,
    ]);
})


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
