<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum IdeaScoreCriterion: string
{
    use EnumTrait;

    case STRATEGIC_FIT = 'strategic_fit';
    case MARKET_NEED_VALUE = 'market_need_value';
    case FEASIBILITY_EFFORT = 'feasibility_effort';
    case MONETIZATION_POTENTIAL = 'monetization_potential';
    case EXCITEMENT_MOTIVATION = 'excitement_motivation';
    case UNIQUENESS = 'uniqueness';
    case INNOVATION = 'innovation';
    case TARGET_AUDIENCE_REACH = 'target_audience_reach';
    case LEARNING_POTENTIAL = 'learning_potential';
    case OPERATIONAL_OVERHEAD = 'operational_overhead';
    case UX_UI_COMPLEXITY = 'ux_ui_complexity';

    public function label(): string
    {
        return match ($this) {
            self::MARKET_NEED_VALUE => 'Market Need/Value',
            self::FEASIBILITY_EFFORT => 'Feasibility (Effort)',
            self::EXCITEMENT_MOTIVATION => 'Excitement/Motivation',
            self::UX_UI_COMPLEXITY => 'UX/UI Complexity',
            default => ucwords(str_replace('_', ' ', $this->value))
        };
    }
}
