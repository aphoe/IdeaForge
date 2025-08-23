<?php

namespace App\Observers;

use App\Classes\ModelManager;
use App\Models\IdeaCategory;

class IdeaCategoryObserver
{
    public function creating(IdeaCategory $ideaCategory): void
    {
        $ideaCategory->identifier = (new ModelManager)->identifier($ideaCategory);
        $ideaCategory->slug = (new ModelManager)->slug($ideaCategory, $ideaCategory->name);
    }
}
