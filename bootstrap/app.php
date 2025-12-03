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
    ->withMiddleware(function (Middleware $middleware): void {
          $middleware->alias([
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\RolMiddleware::class,
        'role' => \App\Http\Middleware\CheckRole::class, // 👈 este es el de roles
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
