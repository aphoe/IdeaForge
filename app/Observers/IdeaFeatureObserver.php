<?php

namespace App\Observers;

use App\Models\IdeaFeature;
use App\Services\IdeaFeatureService;

class IdeaFeatureObserver
{
    public function creating(IdeaFeature $ideaFeature): void
    {
        $ideaFeature->loadMissing('idea');
        $ideaFeature->code = (new IdeaFeatureService())->genCode($ideaFeature->idea);
    }
}
