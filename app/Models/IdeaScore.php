<?php

namespace App\Models;

use App\Observers\IdeaScoreObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([IdeaScoreObserver::class])]
#[ObservedBy([IdeaScoreObserver::class])]
class IdeaScore extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'criteria' => 'array',
        ];
    }

    /*
     * Relationships
     */

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
