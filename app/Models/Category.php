<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Category extends Model
{
    /** @var string $title */
    protected $title;

    /** @var string $slug */
    protected $slug;

    /** @var Collection $recipes */
    protected $recipes;

    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
