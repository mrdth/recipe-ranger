<?php

namespace App\Http\Controllers;

use App\Actions\FetchRecipe;
use Illuminate\Http\Request;

class ShowRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, FetchRecipe $action)
    {
        $recipe = null;
        $validation = null;

        if ($request->recipe) {
            if (!$recipe = $action->handle($request->recipe)) {
                $validation = 'Unfortunately, we could not parse that recipe!';
            }
        }

        return view('form', [
            'recipe' => $recipe,
            'url' => $request->recipe,
            'validation' => $validation,
        ]);
    }
}
