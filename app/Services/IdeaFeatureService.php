<?php
namespace App\Services;

use App\Models\Idea;
use App\Models\IdeaFeature;
use Illuminate\Support\Str;

class IdeaFeatureService
{
    /**
     * Generate a unique code for an idea feature based on its idea code.
     *
     * @param Idea $idea
     * @return string
     */
    public function genCode(Idea $idea): string
    {
        $idea->loadCount('features');
        $number = $idea->features_count + 1;
        $code = $idea->code . '-' . Str::padLeft((string) $number, 4, '0');

        while(IdeaFeature::where('code', $code)->exists()){
            $number++;
            $code = $idea->code . '-' . Str::padLeft((string) $number, 4, '0');
        }

        return $code;
    }
}
