<?php

namespace Modules\Users\Http\Routes;

use Modules\Users\Http\Controllers\Web\UserWebController;
use Route;

Route::prefix('users')->group(function () {
    Route::get('', [UserWebController::class, 'index'])->name('user');
});
