<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipe extends Model
{
    protected $title;

    protected $slug;

    protected $cooking_time;

    protected $preparation_time;

    protected $ingredients;

    protected $feeds;

    protected $tags;

    protected $steps;

    protected $link;

    protected $thumbnail;

    protected $picture;

    protected $casts = [
        'cooking_time' => 'int',
        'preparation_time' => 'int',
        'feeds' => 'int',
    ];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getCookingTime(): int
    {
        return $this->cooking_time;
    }

    public function getPreparationTime(): int
    {
        return $this->preparation_time;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getFeeds(): int
    {
        return $this->feeds;
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
