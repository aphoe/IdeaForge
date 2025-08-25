<?php

namespace App\Filament\Resources\IdeaFeatureResource\Pages;

use App\Filament\Resources\IdeaFeatureResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIdeaFeature extends CreateRecord
{
    protected static string $resource = IdeaFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
