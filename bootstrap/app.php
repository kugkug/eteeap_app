<?php

use App\Http\Middleware\CurrentUserInfo;
use App\Http\Middleware\IsAdminApi;
use App\Http\Middleware\IsAdminWeb;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'current_user' => CurrentUserInfo::class,
            'is_admin_web' => IsAdminWeb::class,
            'is_admin_api' => IsAdminApi::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();