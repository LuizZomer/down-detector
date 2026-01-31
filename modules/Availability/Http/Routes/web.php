<?php

namespace Modules\Availability\Http\Routes;

use Modules\Availability\Http\Controllers\Web\AvailabilityWebController;
use Route;

Route::get('/availability', [AvailabilityWebController::class, 'index'])->name('availability.index');
Route::post('/availability', [AvailabilityWebController::class, 'store'])->name('availability.store');
