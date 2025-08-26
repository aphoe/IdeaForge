<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\IdeaKnowledge;
use App\Services\IdeaService;

class IdeaKnowledgeObserver
{
    public function creating(IdeaKnowledge $ideaKnowledge): void
    {
        $mgr = new ModelManager();

        $ideaKnowledge->identifier = $mgr->identifier($ideaKnowledge);
        $ideaKnowledge->slug = $mgr->slug($ideaKnowledge, $ideaKnowledge->title);
    }

    public function saved(IdeaKnowledge $ideaKnowledge): void
    {
        $ideaKnowledge->loadMissing('idea.knowledges');
        $idea = $ideaKnowledge->idea;
        $service = new IdeaService();

        $progress = $service->calcKnowledgeProgress($idea);
        $idea->knowledge_progress = $progress;
        $idea->save();
    }
}
