<?php

namespace Modules\Availability\Http\Controllers\Web;

use Inertia\Inertia;

class AvailabilityWebController
{
    public function index()
    {
        return Inertia::render('Availability::ListAvailability', [
            'availabilities' => []
        ]);
    }
}
