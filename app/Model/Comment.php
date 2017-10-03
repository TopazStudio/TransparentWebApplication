<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CRUDable
{

    protected $fillable = [
        'content',
        'likes',
        'dislikes',
        'topicId',
        'userId',
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'content',
                'likes',
                'dislikes',

            ],
            'relationships' => [
                'topicId'=> null,
                'userId' => null,
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

    //topic
    public function topic(){
        return $this->belongsTo('App\Model\Topic','topicId');
    }

    //reply
    public function replies(){
        return $this->hasMany('App\Model\Reply','commentId');
    }
}
