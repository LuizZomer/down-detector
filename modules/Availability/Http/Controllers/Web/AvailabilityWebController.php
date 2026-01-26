<?php

namespace Modules\Availability\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AvailabilityWebController
{
    public function index(Request $request)
    {
        $filters = [
            'status' => $request->query('status', null),
        ];

        return Inertia::render('Availability::ListAvailability', [
            'availabilities' => []
        ]);
    }
}
