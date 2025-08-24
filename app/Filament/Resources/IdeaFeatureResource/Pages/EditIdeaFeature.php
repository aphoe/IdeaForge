<?php

namespace App\Filament\Resources\IdeaFeatureResource\Pages;

use App\Filament\Resources\IdeaFeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIdeaFeature extends EditRecord
{
    protected static string $resource = IdeaFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
