<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Repository;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Application\DTO\UpdateMonitorData;
use Modules\Availability\Domain\Entity\UptimeCheck;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Infrastructure\Mapper\MonitorMapper;
use Modules\Availability\Infrastructure\Mapper\UptimeCheckMapper;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\UptimeCheckModel;

class MonitorRepository implements MonitorRepositoryInterface
{
    public function getAll(): Collection
    {
        return MonitorMapper::collectionToEntities(
            MonitorModel::query()->get()
        );
    }

    public function getById(int $id): ?Monitor
    {
        $model = MonitorModel::find($id);

        return $model
            ? MonitorMapper::modelToEntity($model)
            : null;
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

    public function create(Monitor $monitor): MonitorModel
    {
        $data = MonitorMapper::entityToModel($monitor);

        return MonitorModel::create($data);
    }

    public function update(int $id, UpdateMonitorData $data): int
    {
        return MonitorModel::where('id', $id)->update($data->toArray());
    }

    public function createUptime(UptimeCheck $uptimeCheck): UptimeCheckModel
    {
        $data = UptimeCheckMapper::entityToModel($uptimeCheck);

        return UptimeCheckModel::create($data);
    }

    public function softDeleteOrFail(int $id): void
    {
        if (MonitorModel::where('id', $id)->where('user_id', Auth::id())->delete() === 0) {
            throw new ModelNotFoundException();
        }
    }
}
