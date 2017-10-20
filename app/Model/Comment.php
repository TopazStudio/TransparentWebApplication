<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Comment extends Model implements CRUDable
{
    use Searchable;

//CRUD
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

//INDEXING

    public $documentIndex =  'comments';

    public static $types = null;

    public static function index(){
        if (self::$types)
            foreach (self::$types as $type){
                $models = self::where('type','=',$type)->get();
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
