<?php

namespace App\Filament\Resources\IdeaCategoryResource\Pages;

use App\Filament\Resources\IdeaCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdeaCategories extends ListRecords
{
    protected static string $resource = IdeaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
