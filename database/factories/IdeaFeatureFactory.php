<?php

namespace Database\Factories;

use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\IdeaFeature;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class IdeaFeatureFactory extends Factory
{
    protected $model = IdeaFeature::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'feature' => $this->faker->text(),
            'status' => IdeaStatus::fake(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'idea_id' => Idea::factory(),
        ];
    }
}
