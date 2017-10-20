<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
//CRUD
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location',
        'picturable_id',
        'picturable_type',
    ];

    public function pic(){
        return $this->morphTo();
    }
}
