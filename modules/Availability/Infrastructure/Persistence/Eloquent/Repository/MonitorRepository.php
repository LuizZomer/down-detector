<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Repository;

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


    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        $paginator = MonitorModel::query()->paginate($perPage);

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
}
