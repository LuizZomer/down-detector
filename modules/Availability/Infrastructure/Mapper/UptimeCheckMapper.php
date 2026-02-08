<?php

namespace Modules\Availability\Infrastructure\Mapper;

use Modules\Availability\Domain\Entity\UptimeCheck;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\UptimeCheckModel;

class UptimeCheckMapper
{
    public static function modelToEntity(UptimeCheckModel $uptimeCheckModel): UptimeCheck
    {
        return new UptimeCheck(
            responseTimeMs: $uptimeCheckModel->response_time_ms,
            status: $uptimeCheckModel->status,
            httpStatusCode: $uptimeCheckModel->http_status_code,
            reason: $uptimeCheckModel->reason,
            monitorId: $uptimeCheckModel->monitor_id,
            createdAt: $uptimeCheckModel->created_at,
        );
    }

    public static function entityToModel(UptimeCheck $uptimeCheck): array
    {
        return [
            'response_time_ms' => $uptimeCheck->responseTimeMs,
            'status' => $uptimeCheck->status,
            'http_status_code' => $uptimeCheck->httpStatusCode,
            'reason' => $uptimeCheck->reason,
            'monitor_id' => $uptimeCheck->monitorId,
            'created_at' => $uptimeCheck->createdAt,
        ];
    }
}
