<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $name;

    protected $picture;

    protected $thumbnail;

    protected $hidden = ['pivot'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
