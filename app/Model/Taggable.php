<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type',
    ];
}
