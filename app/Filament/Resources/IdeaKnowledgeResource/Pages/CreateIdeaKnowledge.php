<?php

namespace App\Filament\Resources\IdeaKnowledgeResource\Pages;

use App\Filament\Resources\IdeaKnowledgeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIdeaKnowledge extends CreateRecord
{
    protected static string $resource = IdeaKnowledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
