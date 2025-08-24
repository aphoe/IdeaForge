<?php
namespace App\Services;

use App\Enums\IdeaScoreCriterion;
use App\Models\IdeaScore;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class IdeaScoreService
{
    /**
     * Get the form component for the idea score.
     *
     * @param bool $returnArray
     * @return array|Field
     * @throws \Exception
     */
    public function formComponent(bool $returnArray = true): array|Field
    {
        $component = Repeater::make('criteria')
            ->schema([
                Select::make('criterion')
                    ->options(IdeaScoreCriterion::labelArray())
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->required(),
                TextInput::make('score')
                    ->integer()
                    ->minValue(0)
                    ->maxValue(10)
                    ->required(),
            ])
            ->columns(2)
            ->columnSpanFull()
            ->defaultItems(count(IdeaScoreCriterion::cases()))
            ->addable(false)
            ->deletable(false)
            ->reorderable(false)
            ->reorderableWithDragAndDrop(false)
            ->itemLabel(fn (array $state): ?string => IdeaScoreCriterion::tryFrom($state['criterion'])?->label() ?? null);

        if($returnArray){
            return [$component];
        }

        return $component;
    }

    /**
     * Calculate the score of an idea based on its criteria.
     *
     * @param IdeaScore $ideaScore
     * @param bool $round
     * @return float
     */
    public function score(IdeaScore $ideaScore, bool $round = true): float
    {
        $total = count(IdeaScoreCriterion::cases());
        $sum = 0;

        foreach ($ideaScore->criteria as $criterion){
            $sum += $criterion['score'];
        }

        $score = $sum / $total;

        if ($round) {
            return number_format($score, 2, thousands_separator: null);
        }

        return $score;
    }
}
