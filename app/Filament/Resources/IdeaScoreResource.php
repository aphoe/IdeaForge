<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\IdeaScoreResource\Pages;
use App\Models\IdeaScore;
use App\Services\IdeaScoreService;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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

class IdeaScoreResource extends Resource
{
    protected static ?string $model = IdeaScore::class;

    protected static ?string $slug = 'idea-scores';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static ?string $navigationLabel = 'Scores';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return NavigationGroup::Idea->label();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('identifier')
                    ->visibleOn('view'),

                TextInput::make('score')
                    ->visibleOn('view'),

                (new IdeaScoreService())->formComponent(returnArray:  false),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->state(fn(?IdeaScore $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->state(fn(?IdeaScore $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                TextColumn::make('idea.title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('identifier'),

                TextColumn::make('score')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
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
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdeaScores::route('/'),
            'create' => Pages\CreateIdeaScore::route('/create'),
            'view' => Pages\ViewIdeaScore::route('/{record}/'),
            'edit' => Pages\EditIdeaScore::route('/{record}/edit'),
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
            $details['idea'] = $record->idea->title;
        }

        return $details;
    }
}
