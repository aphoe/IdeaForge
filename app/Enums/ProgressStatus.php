<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ProgressStatus: string
{
    use EnumTrait;

    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case SUSPENDED = 'suspended';
    case COMPLETED = 'completed';
    case ABANDONED = 'abandoned';
    case CANCELLED = 'cancelled';

    public function badge(): string
    {
        return match ($this) {
            self::NOT_STARTED => 'gray',
            self::IN_PROGRESS => 'primary',
            self::PAUSED => 'warning',
            self::SUSPENDED => 'warning',
            self::COMPLETED => 'success',
            self::ABANDONED => 'danger',
            self::CANCELLED => 'danger',
        };
    }
}
