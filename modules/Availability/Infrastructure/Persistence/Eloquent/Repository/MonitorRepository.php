<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Repository;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Infrastructure\Mapper\MonitorMapper;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;
use Modules\Availability\Domain\Entity\Monitor;

class MonitorRepository implements MonitorRepositoryInterface
{
    public function getAll(): Collection
    {
        return MonitorMapper::collectionToEntities(
            MonitorModel::query()->get()
        );
    }

    public function getById(int $id): Collection
    {
        return MonitorModel::where('id', $id)->first();
    }

    public function hasMonitor(int $id): bool
    {
        return MonitorModel::where('id', $id)->exists();
    }

    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $paginator = MonitorModel::query()
            ->where('user_id', Auth::id())
            ->when(
                $filters['status'] ?? null,
                fn($query, $status) =>
                $query->where('monitoring_status', $status)
            )
            ->paginate($perPage);

        $paginator->setCollection(
            MonitorMapper::collectionToEntities(
                $paginator->getCollection()
            )
        );

        return $paginator;
    }

    public function create(Monitor $monitor)
    {
        $data = MonitorMapper::entityToModel($monitor);

        return MonitorModel::create($data);
    }

    public function softDeleteOrFail(int $id): void
    {
        if (MonitorModel::where('id', $id)->where('user_id', Auth::id())->delete() === 0) {
            throw new ModelNotFoundException();
        }
    }
}
