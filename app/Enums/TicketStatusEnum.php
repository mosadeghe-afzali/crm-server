<?php

namespace App\Enums;

enum TicketStatusEnum: int
{
    case PENDING_RESPONSE = 1;
    case IN_PROGRESS = 2;
    case RESPONDED = 3;
    case CLOSED = 4;

    public function label(): string
    {
        return match ($this) {
            self::PENDING_RESPONSE => 'منتظر پاسخ',
            self::IN_PROGRESS => 'درحال بررسی',
            self::RESPONDED => 'پاسخ داده شده',
            self::CLOSED => 'بسته شده',
        };
    }
}
