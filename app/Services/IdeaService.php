<?php
namespace App\Services;

use App\Models\Idea;

class IdeaService
{
    /**
     * Calculate the knowledge progress of an idea.
     *
     * @param Idea $idea
     * @return float
     */
    public function calcKnowledgeProgress(Idea $idea): float
    {
        $idea->loadMissing('knowledges');
        $idea->loadCount('knowledges');

        $total = $idea->knowledges_count;

        if($total === 0){
            return 100;
        }

        $sum = 0;

        foreach ($idea->knowledges as $knowledge) {
            $sum += $knowledge->progress;
        }

        $average = $sum / $total;

        return number_format($average, 2, thousands_separator: null);
    }

    /**
     * Generate a unique code for an idea based on its title.
     *
     * @param string $title
     * @return string
     */
    public function genCode(string $title): string
    {
        $code = preg_filter('/[^A-Z]/', '', ucwords($title));
        $count = 1;

        while(Idea::where('code', $code)->exists()){
            $code = $code . $count;
            $count++;
        }

        return $code;
    }
}
