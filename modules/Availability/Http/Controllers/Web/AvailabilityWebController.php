<?php

namespace Modules\Availability\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Availability\Http\Request\StoreAvailabilityRequest;

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

    public function store(StoreAvailabilityRequest $request)
    {
        $dto = $request->toDto();
    }
}
