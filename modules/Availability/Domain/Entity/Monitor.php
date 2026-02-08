<?php

namespace Modules\Availability\Domain\Entity;

use DateTime;
use Modules\Availability\Application\Dto\StoreAvailabilityDto;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;

class Monitor
{
    public function __construct(
        public readonly ?int $id,
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

    public function isActive(): bool
    {
        return $this->monitoringStatus === MonitoringStatusEnum::ACTIVE;
    }

    public static function fromStoreDto(StoreAvailabilityDto $dto): self
    {
        return new self(
            id: null,
            name: $dto->name,
            url: $dto->url,
            errorSendEmail: $dto->errorSendEmail,
            lastCheckedAt: null,
            lastCheckStatus: null,
            lastResponseTimeMs: null,
            frequencySeconds: $dto->frequencySeconds,
            monitoringStatus: MonitoringStatusEnum::ACTIVE,
            userId: $dto->userId,
            createdAt: null,
            updatedAt: null,
        );
    }
}
