<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\artisan;

beforeEach(
    fn() => Http::fake([
        'https://www.bbcgoodfood.com/recipes/air-fryer-chicken-thighs#Recipe' =>
            Http::response(File::get(__DIR__ . "/../data/recipe.html"), 200),
    ])
);

it('can import a recipe', function () {
    expect(Recipe::all()->count())->toBe(0);

    artisan('import:recipe')
        ->expectsQuestion(
            'What is the URL to the recipe?',
            'https://www.bbcgoodfood.com/recipes/air-fryer-chicken-thighs#Recipe'
        )
        ->expectsOutput("Recipe 'Air fryer chicken thighs' imported")
        ->assertExitCode(0);

    expect(Recipe::all()->count())->toBe(1);
});
