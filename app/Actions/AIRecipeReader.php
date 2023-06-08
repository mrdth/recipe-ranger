<?php

namespace App\Actions;

use App\Models\Recipe;
use App\RecipeParser;
use Brick\StructuredData\Reader\JsonLdReader;
use DOMDocument;
use OpenAI;

class AIRecipeReader
{
    protected $client;

    public function __construct()
    {
        $this->setClient(OpenAI::client(config('ai.open_ai_key')));
    }

    public function handle($url): ?Recipe
    {
        $prompt = "Extract only the following information from the recipe found here: $url

            - dishName
            - publishDate (in YYYY-MM-DD format)
            - total cook time (in human-readable format)
            - author
            - ingredients
            - steps (array of strings)
            - servings

            Please generate the output as valid JSON, preferably in ld+json format based on schema.org specificiation.";

        $result = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $dom = new DOMDocument();
        $html = mb_convert_encoding(
            '<script type="application/ld+json">' . $result->choices[0]->message->content . '</script>',
            'HTML-ENTITIES',
            "UTF-8"
        );
        $dom->loadHTML($html);
        $items = (new JsonLdReader())->read($dom, $url);

        $recipe = RecipeParser::fromItems($items, $url);
        $recipe->ai_generated = true;

        return $recipe;
    }

    public function setClient(OpenAI\Client | OpenAI\Testing\ClientFake $client): self
    {
        $this->client = $client;

        return $this;
    }
}
