<?php

namespace App\Filament\Resources\IdeaCategoryResource\Pages;

use App\Filament\Resources\IdeaCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIdeaCategory extends CreateRecord
{
    protected static string $resource = IdeaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
