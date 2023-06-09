<?php

use App\Models\Recipe;
use App\RecipeParser;
use Brick\StructuredData\HTMLReader;
use Brick\StructuredData\Reader\JsonLdReader;

function makeItems(): array
{
    $html = mb_convert_encoding(file_get_contents(__DIR__ . "/../data/recipe.html"), 'HTML-ENTITIES', "UTF-8");

    return (new HTMLReader(new JsonLdReader()))->read(
        $html,
        'https://www.bbcgoodfood.com/recipes/air-fryer-chicken-thighs#Recipe'
    );
}

it('can be instantiated', function () {
    $parser = new RecipeParser();
    expect($parser)->toBeInstanceOf(RecipeParser::class);
});

it('can be make a recipe from items', function () {
    $items = makeItems();
    $recipe = RecipeParser::fromItems($items, 'https://www.bbcgoodfood.com/recipes/air-fryer-chicken-thighs#Recipe');

    expect($recipe)
        ->toBeInstanceOf(Recipe::class)
        ->and($recipe->attributesToArray())->toBe([
            'title' => 'Air fryer chicken thighs',
            'url' => 'https://www.bbcgoodfood.com/recipes/air-fryer-chicken-thighs#Recipe',
            'author' => '',
            'description' => 'Cooking chicken thighs in an air fryer is a speedy way to achieve succulent meat with a delicious crispy skin. A spicy coating makes the perfect finishing touch',
            'ingredients' => [
                "1 tsp paprika",
                "½ tsp  mixed herbs",
                "½ tsp  garlic granules (optional)",
                "4 chicken thighs, bone in",
                "1 tsp olive oil",
            ],
            'steps' => [
                "Combine the paprika in a bowl with the herbs and garlic granules, if using, together with ½ tsp salt and ½ tsp ground black pepper. Scatter onto a plate. Rub the chicken thighs with the oil, then coat in the spice mix.",
                "Put in the basket of your air fryer and cook, skin-side down, for 10 mins at 180C. Turn over and cook for a further 10-15 mins until cooked through and the skin is crispy. To check they are cooked, pierce the thickest part of the thigh with a knife to see if the juices run clear. Remove from the air fryer immediately to stop the skin from softening.",
            ],
            'yield' => '4',
            'totalTime' => "PT27M",
            'images' => [
                "https://images.immediate.co.uk/production/volatile/sites/30/2022/04/Air-Fryer-Chicken-Thighs-d4575b2.jpg?resize=768,574",
            ],
        ]);
});
