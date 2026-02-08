<?php

namespace Modules\Availability\Infrastructure\Mapper;

use Illuminate\Support\Collection;
use Modules\Availability\Domain\Entity\Monitor;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

class MonitorMapper
{
    public static function modelToEntity(MonitorModel $monitorModel)
    {
        return new Monitor(
            id: $monitorModel->id,
            name: $monitorModel->name,
            url: $monitorModel->url,
            errorSendEmail: $monitorModel->error_send_email,
            lastCheckedAt: $monitorModel->last_checked_at,
            lastCheckStatus: $monitorModel->last_check_status,
            lastResponseTimeMs: $monitorModel->last_response_time_ms,
            frequencySeconds: $monitorModel->frequency_seconds,
            monitoringStatus: $monitorModel->monitoring_status,
            userId: $monitorModel->user_id,
            createdAt: $monitorModel->created_at,
            updatedAt: $monitorModel->updated_at
        );
    }

    public static function collectionToEntities(Collection $models): Collection
    {
        return $models->map(
            fn(MonitorModel $model) => self::modelToEntity($model)
        );
    }

    public static function entityToModel(Monitor $monitor): array
    {
        return [
            'id' => $monitor->id,
            'name' => $monitor->name,
            'url' => $monitor->url,
            'error_send_email' => $monitor->errorSendEmail,
            'last_checked_at' => $monitor->lastCheckedAt,
            'last_check_status' => $monitor->lastCheckStatus,
            'last_response_time_ms' => $monitor->lastResponseTimeMs,
            'frequency_seconds' => $monitor->frequencySeconds,
            'monitoring_status' => $monitor->monitoringStatus->value,
            'user_id' => $monitor->userId,
            'created_at' => $monitor->createdAt,
            'updated_at' => $monitor->updatedAt,
        ];
    }
}
