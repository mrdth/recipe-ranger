<?php

namespace App\View\Components;

use App\Models\Recipe;
use Illuminate\View\Component;
use Illuminate\View\View;
use Spatie\Url\Url;

class RecipeCard extends Component
{
    public array $site;

    public function __construct(public Recipe $recipe)
    {
        $url = Url::fromString($this->recipe->url);
        $this->site['name'] = $url->getAuthority();
        $this->site['url'] = $url->getScheme() . '://' . $url->getAuthority();
    }

    public function render(): View
    {
        return view('components.recipe-card');
    }
}
