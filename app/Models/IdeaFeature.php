<?php

namespace App\Models;

use App\Observers\IdeaFeatureObserver;
use App\Traits\ModelIdeaStatus;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([IdeaFeatureObserver::class])]
class IdeaFeature extends Model
{
    use HasFactory;
    use ModelIdeaStatus;

    protected $guarded = [];

    /*
     * Relationships
     */

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
