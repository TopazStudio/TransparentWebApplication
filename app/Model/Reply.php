<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //RELATIONSHIPS

    //reply
    public function comment(){
        return $this->belongsTo('App\Model\Comment','commentId');
    }
}
