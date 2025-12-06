<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AuthWebController extends Controller
{
    public function index()
    {
        return Inertia::render("Auth::test");
    }
}
