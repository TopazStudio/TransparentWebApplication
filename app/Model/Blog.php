<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //RELATIONSHIPS

    //user
    public function user(){
        return $this->belongsTo('App\Model\User','userId');
    }

    //oompany
    public function companiesAbout(){
        return $this->belongsToMany('App\Model\Company','company_related_blogs','blogId','companyId');
    }

    //topic
    public function topic(){
        return $this->belongsTo('App\Model\Topic','topicId');
    }
}
