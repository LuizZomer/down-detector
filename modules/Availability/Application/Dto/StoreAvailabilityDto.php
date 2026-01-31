<?php

namespace Modules\Availability\Application\Dto;

class StoreAvailabilityDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly bool $errorSendEmail,
        public readonly int $frequencySeconds,
        public readonly int $userId,
    ) {
    }
}
