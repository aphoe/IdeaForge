<?php

namespace App\Models;

use App\Observers\IdeaCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([IdeaCategoryObserver::class])]
class IdeaCategory extends Model
{
    use HasFactory;

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'identifier';
    }

    protected $guarded = [];
}
