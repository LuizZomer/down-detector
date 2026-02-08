<?php

namespace Modules\Availability\Domain\Entity;

use DateTimeImmutable;
use Modules\Availability\Domain\ValueObjects\CheckStatusEnum;

class UptimeCheck
{
    public function __construct(
        public int $responseTimeMs,
        public CheckStatusEnum $status,
        public ?int $httpStatusCode,
        public ?string $reason,
        public int $monitorId,
        public DateTimeImmutable $createdAt,
        public ?int $id = null,
    ) {
    }
}
