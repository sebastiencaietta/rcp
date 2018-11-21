<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @var string $title */
    protected $title;

    /** @var string $color */
    protected $color;

    protected $hidden = ['pivot'];
}
