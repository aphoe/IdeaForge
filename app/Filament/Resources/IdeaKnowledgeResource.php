<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Enums\ProgressStatus;
use App\Filament\Resources\IdeaKnowledgeResource\Pages;
use App\Models\IdeaKnowledge;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class IdeaKnowledgeResource extends Resource
{
    protected static ?string $model = IdeaKnowledge::class;

    protected static ?string $slug = 'idea-knowledge';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Knowledge';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return NavigationGroup::Idea->label();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('slug')
                    ->visibleOn('view'),

                TextInput::make('identifier')
                    ->visibleOn('view'),

                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->columnSpanFull()
                    ->required(),

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->sortable()
                    ->rowIndex(),

                TextColumn::make('title')
                ->searchable()
                ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('idea.title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('progress')
                    ->searchable()
                    ->sortable()
                    ->suffix('%'),

                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => ProgressStatus::tryFrom($state)->badge())
                    ->formatStateUsing(fn (string $state): string => ProgressStatus::tryFrom($state)->label()),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdeaKnowledges::route('/'),
            'create' => Pages\CreateIdeaKnowledge::route('/create'),
            'view' => Pages\ViewIdeaKnowledge::route('/{record}'),
            'edit' => Pages\EditIdeaKnowledge::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['idea']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'idea.title'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->idea) {
            $details['Idea'] = $record->idea->title;
        }

        return $details;
    }
}
