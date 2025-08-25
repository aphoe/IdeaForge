<?php

namespace App\Filament\Resources\IdeaFeatureResource\Pages;

use App\Filament\Resources\IdeaFeatureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIdeaFeature extends ViewRecord
{
    protected static string $resource = IdeaFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
