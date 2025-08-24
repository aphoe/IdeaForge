<?php

namespace App\Filament\Resources\IdeaScoreResource\Pages;

use App\Filament\Resources\IdeaScoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdeaScores extends ListRecords
{
    protected static string $resource = IdeaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
