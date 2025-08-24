<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\Idea;
use App\Services\IdeaService;

class IdeaObserver
{
    public function creating(Idea $idea): void
    {
        $mgr = new ModelManager();

        $idea->identifier = $mgr->identifier($idea);
        $idea->slug = $mgr->slug($idea, $idea->title);
        $idea->code = (new IdeaService())->genCode($idea->title);
    }
}
