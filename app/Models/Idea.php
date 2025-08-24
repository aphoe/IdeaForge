<?php

namespace App\Models;

use App\Observers\IdeaObserver;
use App\Traits\ModelIdeaStatus;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([IdeaObserver::class])]
class Idea extends Model
{
    use HasFactory;
    use ModelIdeaStatus;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
     * Relationships
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(IdeaCategory::class, 'idea_category_id');
    }

    public function features(): HasMany
    {
        return $this->hasMany(IdeaFeature::class);
    }

    public function score(): HasOne
    {
        return $this->hasOne(IdeaScore::class);
    }
}
