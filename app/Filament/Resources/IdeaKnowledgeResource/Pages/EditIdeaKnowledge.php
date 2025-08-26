<?php

namespace App\Filament\Resources\IdeaKnowledgeResource\Pages;

use App\Filament\Resources\IdeaKnowledgeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIdeaKnowledge extends EditRecord
{
    protected static string $resource = IdeaKnowledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
