<?php

namespace Modules\Availability\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use Modules\Availability\Application\UseCases\CreateAvailabilityUseCase;
use Modules\Availability\Application\UseCases\DeleteAvailabilityUseCase;
use Modules\Availability\Application\UseCases\GetAvailabilityUseCase;
use Modules\Availability\Http\Requests\StoreAvailabilityRequest;

class AvailabilityWebController
{
    public function __construct(
        private GetAvailabilityUseCase $getAvailabilityUseCase,
        private CreateAvailabilityUseCase $createAvailabilityUseCase,
        private DeleteAvailabilityUseCase $deleteAvailabilityUseCase,
    ) {
    }

    public function index(Request $request)
    {
        $filters = [
            'status' => $request->query('status', null),
        ];

        $data = $this->getAvailabilityUseCase->execute($filters);

        return Inertia::render('Availability::ListAvailability', $data);
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $dto = $request->toDto();

        $this->createAvailabilityUseCase->execute($dto);

        return back()->with('success', 'Monitoramento criado com sucesso!');
    }

    public function delete(int $id)
    {
        $this->deleteAvailabilityUseCase->execute($id);

        return back()->with('success', 'Monitoramento deletado com sucesso!');
    }
}
