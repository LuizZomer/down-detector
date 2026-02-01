<?php

namespace Modules\Availability\Domain\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Domain\Entity\Monitor;

interface MonitorRepositoryInterface
{
    public function getAll(): Collection;

    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(Monitor $monitor);
}
