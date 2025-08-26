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
}
