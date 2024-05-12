<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\sessionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->append(sessionMiddleware::class);
        $middleware->use([
            // \Illuminate\Http\Middleware\TrustHosts::class,
            \App\Http\Middleware\VerifySession::class,
           
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
