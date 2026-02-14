<?php

namespace Modules\Availability\Application\UseCases;

use Modules\Availability\Application\Dto\StoreAvailabilityDto;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Infrastructure\Jobs\CheckMonitorUptimeJob;

class CreateAvailabilityUseCase
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
    ) {
    }

    public function execute(StoreAvailabilityDto $dto)
    {
        $monitorForStore = Monitor::fromStoreDto($dto);

        $monitor = $this->monitorRepository->create($monitorForStore);

        CheckMonitorUptimeJob::dispatch($monitor->id);

        return $monitor;
    }
}
