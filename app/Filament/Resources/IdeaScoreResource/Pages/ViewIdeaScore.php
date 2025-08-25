<?php

namespace App\Filament\Resources\IdeaScoreResource\Pages;

use App\Filament\Resources\IdeaScoreResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIdeaScore extends ViewRecord
{
    protected static string $resource = IdeaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
