<?php

namespace Database\Factories;

use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\IdeaCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class IdeaFactory extends Factory
{
    protected $model = Idea::class;

    public function definition(): array
    {
        return [
            'identifier' => Str::uuid7()->toString(),
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'domain_name' => $this->faker->domainName(),
            'brand_name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'problem' => $this->faker->text(),
            'notes' => $this->faker->text(),
            'status' => IdeaStatus::fake(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'idea_category_id' => IdeaCategory::factory(),
        ];
    }
}
