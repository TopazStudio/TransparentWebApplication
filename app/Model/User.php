<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nuwave\Lighthouse\Support\Traits\RelayConnection;

class User extends Authenticatable implements CRUDable
{
    use Notifiable,RelayConnection;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function crudSettings()
    {
        return[
            'hasPicture'=>true,
            'attributes' => [
                'name',
                'email',
                'password',
                'role'
            ],
            'relationships' => [],
            'parentRel' => []
        ];
    }

    //RELATIONSHIPS

    //review
    public function review(){
        return $this->hasOne('App\Model\Review','userId');
    }

    //comments
    public function comments(){
        return $this->hasMany('App\Model\Comment','userId');
    }

    //topics
    public function topics(){
        return $this->hasMany('App\Model\Topic','ownerId');
    }

    //user
    public function joinedTopics(){
        return $this->belongsToMany('App\Model\Topic','topic_joined_users','userId','topicId');
    }

    //blogs
    public function blogs(){
        return $this->hasMany('App\Model\Blog','userId');
    }

    //documents
    public function documents(){
        return $this->hasMany('App\Model\Document','userId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','picturable');
    }


}
