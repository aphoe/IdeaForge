<?php

namespace App\Filament\Resources\IdeaKnowledgeResource\Pages;

use App\Filament\Resources\IdeaKnowledgeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIdeaKnowledge extends ViewRecord
{
    protected static string $resource = IdeaKnowledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
