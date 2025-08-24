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
     * @return float
     */
    public function score(IdeaScore $ideaScore): float
    {
        $total = count(IdeaScoreCriterion::cases());
        $sum = 0;

        foreach ($ideaScore->criteria as $criterion){
            $sum += $criterion['score'];
        }

        return $sum / $total;
    }
}
