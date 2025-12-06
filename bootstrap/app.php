<?php

use App\Exceptions\EmailAlreadyExistsException;
use App\Exceptions\InvalidCredentialException;
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
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->renderable(function (ValidationException $e, $request) {
            $errors = $e->errors();

            return response()->json([
                'message' => collect($errors)->flatten()->first(),
                'errors' => $errors,
            ], $e->status);
        });

        $exceptions->renderable(
            fn(EmailAlreadyExistsException $e) =>
            response()->json([
                'type' => 'EMAIL_ALREADY_EXISTS',
                'message' => $e->getMessage(),
            ], $e->getCode())
        );

        $exceptions->renderable(
            fn(InvalidCredentialException $e) =>
            response()->json([
                'type' => 'INVALID_CREDENTIAL',
                'message' => $e->getMessage(),
            ], $e->getCode())
        );
    })->create();
