<?php

use App\Exceptions\EmailAlreadyExistsException;
use App\Exceptions\InvalidCredentialException;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);

        $middleware->replace(
            \Illuminate\Auth\Middleware\Authenticate::class,
            Authenticate::class
        );

    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->renderable(
            fn(EmailAlreadyExistsException $e) =>
            response()->json([
                'type' => 'EMAIL_ALREADY_EXISTS',
                'message' => $e->getMessage(),
            ], $e->getCode())
        );

        $exceptions->renderable(function (InvalidCredentialException $e, $request) {

            if ($request->inertia() || !$request->expectsJson()) {
                throw ValidationException::withMessages([
                    'email' => 'Credenciais inválidas.',
                ]);
            }

            return response()->json([
                'type' => 'INVALID_CREDENTIAL',
                'message' => $e->getMessage(),
            ], 401);
        });

    })->create();
