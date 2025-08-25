<?php

namespace App\Filament\Resources\IdeaCategoryResource\Pages;

use App\Filament\Resources\IdeaCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIdeaCategory extends ViewRecord
{
    protected static string $resource = IdeaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
