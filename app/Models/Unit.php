<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $casts = [
       'id' => 'int',
    ];

    /** @var string $title */
    public $title;

    public function getId()
    {
        return $this->attributes['id'];
    }
}
