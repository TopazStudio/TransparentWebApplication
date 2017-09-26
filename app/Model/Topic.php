<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //RELATIONSHIP

    //user
    public function owner(){
        return $this->belongsTo('App\Model\User','ownerId');
    }

    //user
    public function joinedUsers(){
        return $this->belongsToMany('App\Model\User','topic_joined_users','topicId','userId');
    }

    //company
    public function companiesAbout(){
        return $this->belongsToMany('App\Model\Company','company_related_topics','topicId','companyId');
    }

    //comments
    public function comments(){
        return $this->hasMany('App\Model\Comment','topicId');
    }

    //blogs
    public function blogs(){
        return $this->hasMany('App\Model\Blog','topicId');
    }
}
