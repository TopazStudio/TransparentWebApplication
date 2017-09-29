<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //RELATIONSHIPS

    //review
    public function review(){
        return $this->hasMany('App\Model\Review','companyId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','pic');
    }

    //document
    public function documents(){
        return $this->hasMany('App\Model\Document','companyId');
    }

    //topics
    public function relatedTopics(){
        return $this->belongsToMany('App\Model\Topic','company_related_topics','companyId','topicId');
    }

    //blogs
    public function relatedBlogs(){
        return $this->belongsToMany('App\Model\Blog','company_related_blogs','companyId','blogId');
    }
}
