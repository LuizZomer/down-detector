<?php

namespace Modules\Availability\Application\UseCases;

use Modules\Availability\Application\Dto\StoreAvailabilityDto;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;

class CreateAvailabilityUseCase
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
    ) {
    }

    public function execute(StoreAvailabilityDto $dto)
    {
        $monitor = Monitor::fromStoreDto($dto);

        return $this->monitorRepository->create($monitor);
    }
}
