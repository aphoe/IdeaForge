<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\IdeaStatus;
use App\Enums\NavigationGroup;
use App\Filament\Resources\IdeaFeatureResource\Pages;
use App\Models\IdeaFeature;
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

class IdeaFeatureResource extends Resource
{
    protected static ?string $model = IdeaFeature::class;

    protected static ?string $slug = 'idea-features';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $navigationLabel = 'Features';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return NavigationGroup::Idea->label();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                Select::make('status')
                    ->options(IdeaStatus::labelArray())
                    ->required(),

                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->columnSpanFull()
                    ->required(),

                MarkdownEditor::make('feature')
                    ->columnSpanFull()
                    ->minLength(30)
                    ->maxLength(1500)
                    ->required(),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->state(fn(?IdeaFeature $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->state(fn(?IdeaFeature $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('idea.title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => IdeaStatus::tryFrom($state)->badge())
                    ->formatStateUsing(fn (string $state): string => IdeaStatus::tryFrom($state)->label()),
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
            ->defaultSort('title')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdeaFeatures::route('/'),
            'create' => Pages\CreateIdeaFeature::route('/create'),
            'view' => Pages\ViewIdeaFeature::route('/{record}'),
            'edit' => Pages\EditIdeaFeature::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['idea']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['idea.title'];
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
