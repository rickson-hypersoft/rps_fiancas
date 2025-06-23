<?php

declare(strict_types = 1);

use App\Http\Middleware\AuthTokenMiddleware;
use App\Http\Middleware\CheckUserCategory;
use App\Http\Middleware\CheckUserPermission;
use App\Http\Middleware\VerifyContractLink;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.token'           => AuthTokenMiddleware::class,
            'check.category'       => CheckUserCategory::class,
            'check.permission'     => CheckUserPermission::class,
            'verify.contract.link' => VerifyContractLink::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
