<?php

namespace App\Model;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use App\Util\CRUD\CRUDable;


class Topic extends Model implements CRUDable
{
    use ElasticquentTrait;
//CRUD
    protected $fillable = [
        'name',
        'description',
        'likes',
        'dislikes',
        'ownerId',
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'name',
                'description',
                'likes',
                'dislikes',
                'ownerId',
            ],
            'relationships' => [
                'ownerId' => null,
            ],
            'parentRel' => [
                'ownerId' => null
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
        return 'topics';
    }

    function getTypeName()
    {
        return $this->docTypeName;
    }

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
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

    //tags
    public function tags(){
        return $this->morphToMany('App\Model\Tag', 'taggable');
    }
}
