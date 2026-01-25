<?php

namespace Modules\Availability\Infrastructure\Mapper;

use Illuminate\Support\Collection;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

class MonitorMapper
{
    public static function modelToEntity(MonitorModel $userModel)
    {
        return new Monitor(
            id: $userModel->id,
            name: $userModel->name,
            url: $userModel->url,
            errorSendEmail: $userModel->error_send_email,
            lastCheckedAt: $userModel->last_checked_at,
            lastCheckStatus: $userModel->last_check_status,
            lastResponseTimeMs: $userModel->last_response_time_ms,
            frequencySeconds: $userModel->frequency_seconds,
            monitoringStatus: $userModel->monitoring_status,
            userId: $userModel->user_id,
            createdAt: $userModel->created_at,
            updatedAt: $userModel->updated_at
        );
    }

    public static function collectionToEntities(Collection $models): Collection
    {
        return $models->map(
            fn(MonitorModel $model) => self::modelToEntity($model)
        );
    }
}
