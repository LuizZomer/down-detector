<?php

namespace Modules\Auth\Http\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Web\AuthWebController;

Route::prefix('auth')->group(function () {
    Route::get("/", [AuthWebController::class, "index"])->name('login-screen');
    Route::post("/", [AuthWebController::class, "login"])->name('login');
});

