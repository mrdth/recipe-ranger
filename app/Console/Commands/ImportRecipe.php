<?php

namespace App\Console\Commands;

use App\Actions\FetchRecipe;
use Illuminate\Console\Command;

class ImportRecipe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:recipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a recipe from a provided URL';

    /**
     * Execute the console command.
     */
    public function handle(FetchRecipe $action)
    {
        $add_more = true;
        do {
            $url = $this->ask('What is the URL to the recipe?');

            $recipe = $action->handle($url);
            $recipe->save();

            $this->line("Recipe '{$recipe->title}' imported");
            $add_more = $this->confirm('Add another recipe?', true);
        } while ($add_more);
    }
}
