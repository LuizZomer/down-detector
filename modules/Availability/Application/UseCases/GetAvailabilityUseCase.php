<?php

namespace Modules\Availability\Application\UseCases;

use Modules\Availability\Application\Dto\StoreAvailabilityDto;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;

class GetAvailabilityUseCase
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
    ) {
    }

    public function execute(array $filters)
    {
        $availabilities = $this->monitorRepository->paginate($filters);

        return ['availabilities' => $availabilities];
    }
}
