<?php

namespace Modules\Users\Http\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Api\UserController;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class,'index'])->name('index');
});