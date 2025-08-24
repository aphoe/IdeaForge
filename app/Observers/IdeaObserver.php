<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\Idea;

class IdeaObserver
{
    public function creating(Idea $idea): void
    {
        $idea->identifier = (new ModelManager)->identifier($idea);
        $idea->slug = (new ModelManager)->slug($idea, $idea->title);
    }
}
