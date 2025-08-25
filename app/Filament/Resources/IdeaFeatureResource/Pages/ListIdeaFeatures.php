<?php

namespace App\Filament\Resources\IdeaFeatureResource\Pages;

use App\Filament\Resources\IdeaFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdeaFeatures extends ListRecords
{
    protected static string $resource = IdeaFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
