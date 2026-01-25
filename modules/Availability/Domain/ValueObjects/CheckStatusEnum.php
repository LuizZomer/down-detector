<?php

namespace Modules\Availability\Domain\ValueObjects;

enum CheckStatusEnum: string
{
    case UP = 'up';
    case DOWN = 'down';
    case MAINTENANCE = 'maintenance';
}
