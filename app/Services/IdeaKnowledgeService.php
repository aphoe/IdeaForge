<?php
namespace App\Services;

use App\Enums\ProgressStatus;
use App\Models\IdeaKnowledge;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;

class IdeaKnowledgeService
{
    public function formComponent(bool $showIdea = true): array|Field
    {
        $fields = [
            TextInput::make('title')
                ->columnSpanFull()
                ->required(),

            TextInput::make('slug')
                ->visibleOn('view'),

            TextInput::make('identifier')
                ->visibleOn('view'),

            Select::make('status')
                ->options(ProgressStatus::labelArray())
                ->required(),

            TextInput::make('progress')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),

            MarkdownEditor::make('description')
                ->columnSpanFull(),

            TextEntry::make('created_at')
                ->label('Created Date')
                ->state(fn(?IdeaKnowledge $record): string => $record?->created_at?->diffForHumans() ?? '-'),

            TextEntry::make('updated_at')
                ->label('Last Modified Date')
                ->state(fn(?IdeaKnowledge $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
        ];

        if ($showIdea) {
            return [
                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->columnSpanFull()
                    ->required(),
                ...$fields,
            ];
        }

        return $fields;
    }
}
