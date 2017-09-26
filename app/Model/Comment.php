<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

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
