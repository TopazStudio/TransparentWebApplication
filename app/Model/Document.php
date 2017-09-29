<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //RELATIONSHIPS

    //user
    public function user(){
        return $this->belongsTo('App\Model\User','userId');
    }

    //company
    public function company(){
        return $this->belongsTo('App\Model\Company','companyId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','pic');
    }
}
