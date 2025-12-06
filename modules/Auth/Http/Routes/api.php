<?php

namespace Modules\Auth\Http\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\AuthController;


Route::prefix('auth')->group(function () {
    Route::post('/', [AuthController::class, 'login'])->name('login');
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class,'me'])->name('me');
    });
});
