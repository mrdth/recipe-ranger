<?php

use App\Models\Recipe;

test('fillable attributes', function () {
    expect((new Recipe())->getFillable())->toBe([
        'title',
        'url',
        'author',
        'description',
        'ingredients',
        'steps',
        'yield',
        'totalTime',
        'images',
    ]);
});

test('attribute casts', function () {
    expect((new Recipe())->getCasts())->toBe([
        'id' => 'int',
        'ingredients' => 'array',
        'steps' => 'array',
        'images' => 'array',
    ]);
});
