<?php

namespace App\Models;

use App\Observers\IdeaKnowledgeObserver;
use App\Traits\ModelProgressStatus;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([IdeaKnowledgeObserver::class])]
class IdeaKnowledge extends Model
{
    use HasFactory;
    use ModelProgressStatus;

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $guarded = [];

    /*
     * Relationships
     */

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
