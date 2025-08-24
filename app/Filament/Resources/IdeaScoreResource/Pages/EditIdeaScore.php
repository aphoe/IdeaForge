<?php

namespace App\Filament\Resources\IdeaScoreResource\Pages;

use App\Filament\Resources\IdeaScoreResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIdeaScore extends EditRecord
{
    protected static string $resource = IdeaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
