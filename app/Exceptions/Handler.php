<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (ModelNotFoundException $e, Request $request) {
            if ($request->inertia()) {
                return back()->with(
                    'error',
                    'Monitoramento não encontrado ou você não tem permissão para removê-lo.'
                );
            }
        });
    }
}
