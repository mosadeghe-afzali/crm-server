<?php

namespace App\Enums;

enum TicketPriorityEnum: int
{
    case LOW = 1;
    case INTERMEDIATE = 2;
    case HIGH = 3;

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::INTERMEDIATE => 'Intermediate',
            self::HIGH => 'High',
        };
    }
}
