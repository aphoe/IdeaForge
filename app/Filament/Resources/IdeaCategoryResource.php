<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\IdeaCategoryResource\Pages;
use App\Models\IdeaCategory;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class IdeaCategoryResource extends Resource
{
    protected static ?string $model = IdeaCategory::class;

    protected static ?string $slug = 'idea-categories';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?string $navigationLabel = 'Categories';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return NavigationGroup::Idea->label();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('identifier')
                    ->visibleOn('view'),

                TextInput::make('slug')
                    ->visibleOn('view'),

                ColorPicker::make('color')
                    ->columnSpanFull(),

                MarkdownEditor::make('description')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->state(fn(?IdeaCategory $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->state(fn(?IdeaCategory $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('identifier'),

                TextColumn::make('slug'),

                ColorColumn::make('color'),

                TextColumn::make('ideas_count')
                    ->label('Ideas')
                    ->counts('ideas')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdeaCategories::route('/'),
            'create' => Pages\CreateIdeaCategory::route('/create'),
            'view' => Pages\ViewIdeaCategory::route('/{record}'),
            'edit' => Pages\EditIdeaCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
