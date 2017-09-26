<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

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
