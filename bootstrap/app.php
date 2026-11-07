<?php

use App\Http\Middleware\DecryptIdRequestMiddleware;
use App\Http\Middleware\EncryptIdResponseMiddleware;
use App\Http\Middleware\RecursiveDecryptIdRequestMiddleware;
use App\Http\Middleware\UniversalIdCryptorMiddleware;
use Illuminate\Auth\AuthenticationException;
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
        $middleware->trustProxies(at: '*');
        $middleware->alias([
            'encrypt.response' => EncryptIdResponseMiddleware::class,
            'decrypt.request' => DecryptIdRequestMiddleware::class,
            'id.cryptor' => UniversalIdCryptorMiddleware::class,
            'recursive.decrypt' => RecursiveDecryptIdRequestMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                    'data' => null,
                ], 401);
            }
        });
    })->create();
