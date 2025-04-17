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
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware aliases here
        $middleware->alias([
            'branch.auth' => \App\Http\Middleware\BranchAuth::class,
        ]);
        
        // You can also add middleware to groups here if needed
        // $middleware->appendToGroup('web', \App\Http\Middleware\EncryptCookies::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception handling configuration goes here
        // Not for middleware registration
    })->create();