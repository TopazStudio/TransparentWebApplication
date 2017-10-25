<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model implements CRUDable
{

//CRUD
    //TODO:: add userId column
    protected $fillable = [
        'content',
        'like',
        'dislikes',
        'commentId',
        'userId'
    ];

    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'content',
                'like',
                'dislikes',
            ],
            'relationships' => [
                'commentId' => null,
                'userId'=> null
            ],
            'parentRel' => [
                'userId' => null
            ]
        ];
    }

//RELATIONSHIPS
    //reply
    public function comment(){
        return $this->belongsTo('App\Model\Comment','commentId');
    }

    public function user(){
        return $this->belongsTo('App\Model\User','userId');
    }
}
