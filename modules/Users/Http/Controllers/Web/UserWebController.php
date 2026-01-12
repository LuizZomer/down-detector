<?php

namespace Modules\Users\Http\Controllers\Web;

use Inertia\Inertia;

class UserWebController
{
    public function __construct()
    {
    }

    public function index()
    {
        return Inertia::render('Users::Register');
    }
}
