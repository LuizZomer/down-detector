<?php

namespace Modules\Availability\Domain\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface MonitorRepositoryInterface
{
    public function getAll(): Collection;

    public function paginate(int $perPage = 10): LengthAwarePaginator;
}
