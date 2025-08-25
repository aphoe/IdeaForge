<?php

namespace App\Filament\Resources\IdeaScoreResource\Pages;

use App\Filament\Resources\IdeaScoreResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIdeaScore extends CreateRecord
{
    protected static string $resource = IdeaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
