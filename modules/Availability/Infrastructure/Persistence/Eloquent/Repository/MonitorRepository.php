<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Infrastructure\Mapper\MonitorMapper;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

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
}
