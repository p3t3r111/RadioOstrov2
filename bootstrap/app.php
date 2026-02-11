<?php

use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfHolidays;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\VerifyCronRequest;
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
        $middleware->alias([
            'isAdmin' => CheckIfAdmin::class,
            'cron' => VerifyCronRequest::class,
            'isHoliday' => CheckIfHolidays::class,
        ]);

        $middleware->web([
            SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
