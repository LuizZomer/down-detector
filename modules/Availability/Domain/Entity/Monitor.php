<?php

namespace Modules\Availability\Domain\Entity;

use DateTime;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;

class Monitor
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $url,
        public readonly bool $errorSendEmail,
        public readonly ?DateTime $lastCheckedAt,
        public readonly ?string $lastCheckStatus,
        public readonly ?int $lastResponseTimeMs,
        public readonly int $frequencySeconds,
        public readonly MonitoringStatusEnum $monitoringStatus,
        public readonly int $userId,
        public readonly ?DateTime $createdAt,
        public readonly ?DateTime $updatedAt,
    ) {
    }
}
