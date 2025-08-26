<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\IdeaKnowledge;

class IdeaKnowledgeObserver
{
    public function creating(IdeaKnowledge $ideaKnowledge): void
    {
        $mgr = new ModelManager();

        $ideaKnowledge->identifier = $mgr->identifier($ideaKnowledge);
        $ideaKnowledge->slug = $mgr->slug($ideaKnowledge, $ideaKnowledge->title);
    }
}
