<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nuwave\Lighthouse\Support\Traits\RelayConnection;
use Sleimanx2\Plastic\Facades\Plastic;
use Sleimanx2\Plastic\Searchable;

class User extends Authenticatable implements CRUDable
{
    use Notifiable,RelayConnection,Searchable;

//CRUD
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

//INDEXING

    public $documentIndex =  'users';

    //TODO: make this its own table then create a relationship
    public static $types = [
        'normal',
        'manager',
        'agent',
    ];

    public static function index(){
        if (self::$types)
            foreach (self::$types as $type){
                $models = self::where('role','=',$type)->get();
                if(!empty($models)){
                    foreach ($models as $model){
                        $model->documentType = $type;
                        $model->document()->save();
                    }
                }
            }
        else{
            foreach (static::all() as $model){
                $model->document()->save();
            }
        }
        return true;
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
