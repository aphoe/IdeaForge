<?php

namespace App\Filament\Resources\IdeaKnowledgeResource\Pages;

use App\Filament\Resources\IdeaKnowledgeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdeaKnowledges extends ListRecords
{
    protected static string $resource = IdeaKnowledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
