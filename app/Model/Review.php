<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model implements CRUDable
{

    protected $fillable = [
        'content',
        'likes',
        'dislikes',
        'userId',
        'companyId'
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>true,
            'attributes' => [
                'content',
                'likes',
                'dislikes',
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
