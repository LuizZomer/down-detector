<?php

namespace Modules\Auth\Http\Routes;

use Auth;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Web\AuthWebController;
use Inertia\Inertia;

Route::prefix('auth')->group(function () {
    Route::get("/", [AuthWebController::class, "index"])
        ->name('login');
    Route::post("/", [AuthWebController::class, "login"])
        ->name('login.store');
});

