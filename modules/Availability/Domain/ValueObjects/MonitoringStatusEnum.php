<?php

namespace Modules\Availability\Domain\ValueObjects;

enum MonitoringStatusEnum: string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
}
