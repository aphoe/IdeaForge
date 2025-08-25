<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\IdeaCategory;
use App\Models\IdeaScore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class IdeaScoreFactory extends Factory
{
    protected $model = IdeaScore::class;

    public function definition(): array
    {
        return [
            'identifier' => $this->faker->word(),
            'score' => $this->faker->randomNumber(),
            'criteria' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'idea_id' => Idea::factory(),
        ];
    }
}
