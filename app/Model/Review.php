<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Support\Traits\RelayConnection;

class Review extends Model implements CRUDable
{
    use RelayConnection;

//CRUD
    protected $fillable = [
        'content',
        'userId',
        'companyId'
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'content',
            ],
            'relationships' => [
                'userId' => null,
                'companyId' => null
            ],
            'parentRel' => [
                'userId' => null
            ]
        ];
    }

//RELATIONSHIPS
    //User
    public function user(){
        return $this->belongsTo('App\Model\User','userId');
    }

    //Company
    public function company(){
        return $this->belongsTo('App\Model\Company','companyId');
    }


}
