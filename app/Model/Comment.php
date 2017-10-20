<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Support\Traits\RelayConnection;

class Comment extends Model implements CRUDable
{
    use RelayConnection,ElasticquentTrait;

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

    /**
     * Model's index type
     *
     * @var string
     */
    public $docTypeName;

    public static $types = null;

    function getIndexName()
    {
        return 'comments';
    }

    function getTypeName()
    {
        return $this->docTypeName;
    }

    protected $mappingProperties = array(
        'content' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    public static function index(){
        if (self::$types)
            foreach (self::$types as $type){
                $models = self::where('Type','=',$type)->get();
                if(!empty($models)){
                    foreach ($models as $model){
                        $model->docTypeName = $type;
                    }
                    $models->addToIndex();
                }
            }
        else{
            self::createIndex($shards = null, $replicas = null);

            self::putMapping($ignoreConflicts = true);

            self::addAllToIndex();
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
