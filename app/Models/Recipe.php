<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'author',
        'ingredients',
        'steps',
        'yield',
        'totalTime',
        'images',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array',
        'images' => 'array',
    ];

    public function ingredientRows(): array
    {
        // 3 rows total, get number of ingredients per row
        $perRow = (int)ceil(count($this->ingredients) / 3);
        $ingredients = [0 => [], 1 => [], 2 => []];

        foreach ($ingredients as $column => $rows) {
            $ingredients[$column] = array_slice($this->ingredients, $perRow * $column, $perRow);
        }

        return $ingredients;
    }

    public function humanTotalTime(): ?string
    {
        if ($this->totalTime) {
            try {
                // Fix ld+json from foodnetwork.com
                $interval = Str::replace("DT", "D", $this->totalTime);
                $duration = CarbonInterval::fromString($interval);
                return $duration->forHumans();
            } catch (Exception $e) {
                return null;
            }
        }

        return null;
    }
}
