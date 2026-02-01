<?php

namespace Modules\Availability\Application\UseCases;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;

class DeleteAvailabilityUseCase
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
    ) {
    }

    public function execute(int $id): void
    {
        $this->monitorRepository->softDeleteOrFail($id);
    }

}
