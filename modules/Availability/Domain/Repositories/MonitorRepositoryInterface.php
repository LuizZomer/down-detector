<?php

namespace Modules\Availability\Domain\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Application\DTO\UpdateMonitorData;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Domain\Entity\UptimeCheck;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\UptimeCheckModel;

interface MonitorRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Monitor;

    public function hasMonitor(int $id): bool;

    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator;

    public function create(Monitor $monitor): MonitorModel;

    public function update(int $id, UpdateMonitorData $data): int;

    public function createUptime(UptimeCheck $uptimeCheck): UptimeCheckModel;

    public function softDeleteOrFail(int $id): void;
}
