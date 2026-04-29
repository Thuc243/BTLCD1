<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // 🔥 MIDDLEWARE (QUAN TRỌNG)
    ->withMiddleware(function (Middleware $middleware): void {

        // Đăng ký middleware admin
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'shipper' => \App\Http\Middleware\IsShipper::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

->create();