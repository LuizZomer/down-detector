<?php

namespace Modules\Availability\Domain\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Domain\Entity\Monitor;

interface MonitorRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Collection;

    public function hasMonitor(int $id): bool;

    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator;

    public function create(Monitor $monitor);

    public function softDeleteOrFail(int $id): void;
}
