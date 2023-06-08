<?php

use App\Models\Recipe;

test('fillable attributes', function () {
    expect((new Recipe())->getFillable())->toBe([
        0 => 'title',
        1 => 'url',
        2 => 'author',
        3 => 'ingredients',
        4 => 'steps',
        5 => 'yield',
        6 => 'totalTime',
        7 => 'images',
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
