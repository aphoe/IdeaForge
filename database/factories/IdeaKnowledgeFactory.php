<?php

namespace Database\Factories;

use App\Enums\ProgressStatus;
use App\Models\Idea;
use App\Models\IdeaKnowledge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class IdeaKnowledgeFactory extends Factory
{
    protected $model = IdeaKnowledge::class;

    public function definition(): array
    {
        return [
            'identifier' => Str::uuid7()->toString(),
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'status' => ProgressStatus::fake(),
            'progress' => $this->faker->randomNumber(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'idea_id' => Idea::factory(),
        ];
    }
}
