<?php

namespace App\Traits;

use App\Enums\IdeaStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelIdeaStatus
{
    /**
     * Accessors
     */

    public function statusBadge(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => array_key_exists('status', $attributes) && $attributes['status'] ? IdeaStatus::tryFrom($attributes['status'])->badge() : null,
        );
    }

    public function statusDescription(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => array_key_exists('status', $attributes) && $attributes['status'] ? IdeaStatus::tryFrom($attributes['status'])->description() : null,
        );
    }

    public function statusString(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => array_key_exists('status', $attributes) && $attributes['status'] ? IdeaStatus::tryFrom($attributes['status'])->label() : null,
        );
    }

    /*
     * Scopes
     */

    #[Scope]
    public function status(Builder $builder, string $status): Builder
    {
        return $builder->where('status', $status);
    }
}
