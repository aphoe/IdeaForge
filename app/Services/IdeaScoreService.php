<?php
namespace App\Services;

use App\Enums\IdeaScoreCriterion;
use App\Models\IdeaScore;

class IdeaScoreService
{
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
