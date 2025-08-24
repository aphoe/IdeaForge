<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\IdeaScore;
use App\Services\IdeaScoreService;

class IdeaScoreObserver
{
    public function creating(IdeaScore $ideaScore): void
    {
        $ideaScore->identifier = (new ModelManager)->identifier($ideaScore);
        $ideaScore->score = (new IdeaScoreService)->score($ideaScore);
    }

    public function updating(IdeaScore $ideaScore): void
    {
    }
}
