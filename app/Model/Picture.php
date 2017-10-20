<?php

namespace App\Model;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use ElasticquentTrait;
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
