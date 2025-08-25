<?php

namespace App\Filament\Resources\IdeaCategoryResource\Pages;

use App\Filament\Resources\IdeaCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIdeaCategory extends EditRecord
{
    protected static string $resource = IdeaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
