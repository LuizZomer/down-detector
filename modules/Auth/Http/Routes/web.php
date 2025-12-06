<?php

namespace Modules\Auth\Http\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Web\AuthWebController;


Route::get("/auth-page", [AuthWebController::class, "index"]);
