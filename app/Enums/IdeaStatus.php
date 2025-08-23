<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum IdeaStatus: string
{
    use EnumTrait;

    case DRAFT = 'draft';
    case UNDER_REVIEW = 'under_review';
    case APPROVED = 'approved';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case BACKLOG = 'backlog';
    case ON_HOLD = 'on_hold';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case DUPLICATE = 'duplicate';
    case ARCHIVED = 'archived';
    case LAUNCHED = 'launched';

    public function badge(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::UNDER_REVIEW => 'info',
            self::APPROVED => 'primary',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
            self::BACKLOG => 'warning',
            self::ON_HOLD => 'warning',
            self::REJECTED => 'danger',
            self::CANCELLED => 'danger',
            self::DUPLICATE => 'warning',
            self::ARCHIVED => 'warning',
            self::LAUNCHED => 'success',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::DRAFT => 'A raw, unprocessed idea that has just been captured.',
            self::UNDER_REVIEW => 'The idea is being actively evaluated and scored against defined criteria.',
            self::APPROVED => 'The idea has passed evaluation and is cleared for development.',
            self::IN_PROGRESS => 'Actively being built in the project management phase.', // New description
            self::BACKLOG => 'Approved and waiting to be scheduled for development.',
            self::ON_HOLD => 'Progress is paused pending further information or external factors.',
            self::REJECTED => 'Evaluated and deemed not worth pursuing at this time.',
            self::DUPLICATE => 'A repeat of an existing idea that has already been logged.',
            self::ARCHIVED => 'An old or irrelevant idea kept for historical reference.',
            self::COMPLETED => 'The idea has been completed and is ready for launch.',
            self::CANCELLED => 'The idea has been cancelled and will not be pursued.',
            self::LAUNCHED => 'Idea has been fully developed and is now live.',
        };
    }
}
