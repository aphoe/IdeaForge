<?php

namespace Database\Factories;

use App\Models\IdeaCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class IdeaCategoryFactory extends Factory
{
    protected $model = IdeaCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'color' => $this->faker->hexColor(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
