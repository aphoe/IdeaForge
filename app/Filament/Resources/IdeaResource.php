<?php

namespace App\Filament\Resources;

use App\Classes\ValidationRule;
use App\Enums\IdeaStatus;
use App\Enums\NavigationGroup;
use App\Filament\Resources\IdeaResource\Pages;
use App\Models\Idea;
use App\Models\IdeaScore;
use App\Services\IdeaFeatureService;
use App\Services\IdeaScoreService;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class IdeaResource extends Resource
{
    protected static ?string $model = Idea::class;

    protected static ?string $slug = 'ideas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return NavigationGroup::Idea->label();
    }

    public static function form(Schema $schema): Schema
    {
        if($schema->model instanceof Idea) {
            $schema->model->loadMissing('score');
        }

        $grid = $schema->getOperation() === 'edit' ? 2 : 4;

        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),

                Select::make('idea_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('identifier')
                    ->visibleOn('view'),

                TextInput::make('slug')
                    ->visibleOn('view'),

                TextInput::make('domain_name')
                    ->regex((new ValidationRule())->domainNameRegex()),

                TextInput::make('brand_name'),

                MarkdownEditor::make('description')
                    ->required(),

                MarkdownEditor::make('problem')
                    ->required(),

                MarkdownEditor::make('notes')
                    ->columnSpanFull(),

                Select::make('status')
                    ->options(IdeaStatus::labelArray())
                    ->required(),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->state(fn(?Idea $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->state(fn(?Idea $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                Fieldset::make('Idea Score')
                    ->relationship('score')
                    ->columnSpanFull()
                    ->visibleOn( $schema->model instanceof Idea && $schema->model->score instanceof IdeaScore ? ['edit', 'view'] : 'edit')
                    ->schema((new IdeaScoreService())->formComponent(showLabel: false, grid: $grid, operation: $schema->getOperation())),

                Repeater::make('features')
                    ->relationship('features')
                    ->schema([
                        TextInput::make('title')
                            ->required(),

                        Select::make('status')
                            ->options(IdeaStatus::labelArray())
                            ->required(),

                        MarkdownEditor::make('feature')
                            ->columnSpanFull()
                            ->minLength(30)
                            ->maxLength(1500)
                            ->required(),
                    ])
                    ->visibleOn(['edit', 'view'])
                    ->columns(2)
                    ->columnSpanFull()
                    ->itemLabel(fn (array $state): ?string => $state['title'])
                    ->grid(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                //TextColumn::make('identifier'),

                /*TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),*/

                TextColumn::make('score.score')
                    ->label('Score')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('features_count')
                    ->label('Features')
                    ->counts('features')
                    ->numeric(),

                TextColumn::make('knowledge_progress')
                    ->label('Knowl. Prog.')
                    ->searchable()
                    ->sortable()
                    ->suffix('%'),

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
            ->defaultSort('title');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdeas::route('/'),
            'create' => Pages\CreateIdea::route('/create'),
            'view' => Pages\ViewIdea::route('/{record}'),
            'edit' => Pages\EditIdea::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->category) {
            $details['category'] = $record->category->name;
        }

        return $details;
    }
}
