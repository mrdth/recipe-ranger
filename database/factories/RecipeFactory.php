<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = File::json(__DIR__ . '/recipe_data.json');

        return [
            'title' => Arr::random($data['titles'], 1)[0],
            'url' => fake()->url,
            'author' => fake()->name,
            'ingredients' => Arr::random($data['ingredients'], fake()->numberBetween(7, 20)),
            'steps' => Arr::random($data['steps'], fake()->numberBetween(2, 4)),
            'yield' => fake()->numberBetween(2, 6),
            'totalTime' => Arr::random($data['totalTime'], 1)[0],
            'images' => Arr::random($data['images'], 1),
        ];
    }
}
