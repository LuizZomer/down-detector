<?php

namespace Modules\Availability\Application\DTO;

use DateTimeImmutable;
use Modules\Availability\Domain\ValueObjects\CheckStatusEnum;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;

class UpdateMonitorData
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $url = null,
        public readonly ?bool $errorSendEmail = null,
        public readonly ?DateTimeImmutable $lastCheckedAt = null,
        public readonly ?CheckStatusEnum $lastCheckStatus = null,
        public readonly ?int $lastResponseTimeMs = null,
        public readonly ?int $frequencySeconds = null,
        public readonly ?MonitoringStatusEnum $monitoringStatus = null,
        public readonly ?int $userId = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'url' => $this->url,
            'error_send_email' => $this->errorSendEmail,
            'last_checked_at' => $this->lastCheckedAt?->format('Y-m-d H:i:s'),
            'last_check_status' => $this->lastCheckStatus,
            'last_response_time_ms' => $this->lastResponseTimeMs,
            'frequency_seconds' => $this->frequencySeconds,
            'monitoring_status' => $this->monitoringStatus,
            'user_id' => $this->userId,
        ], static fn($value) => $value !== null);
    }
}
