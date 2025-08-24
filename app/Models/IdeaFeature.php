<?php

namespace App\Models;

use App\Traits\ModelIdeaStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeaFeature extends Model
{
    use HasFactory;
    use ModelIdeaStatus;

    /*
     * Relationships
     */

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
