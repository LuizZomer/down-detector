<?php

namespace Modules\Availability\Http\Routes;

use Modules\Availability\Http\Controllers\Web\AvailabilityWebController;
use Route;

Route::middleware('web')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::prefix('/availability')->group(function () {
            Route::get('', [AvailabilityWebController::class, 'index'])->name('availability.index');
            Route::post('', [AvailabilityWebController::class, 'store'])->name('availability.store');
            Route::delete('{id}', [AvailabilityWebController::class, 'delete'])->name('availability.delete');
        });
    });
});
