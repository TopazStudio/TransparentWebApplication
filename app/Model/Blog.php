<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Blog extends Model implements CRUDable
{
    use ElasticquentTrait;
//CRUD

    protected $fillable = [
        'url',
        'heading',
        'content',
        'userId',
        'topicId'
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'url',
                'heading',
                'content',
            ],
            'relationships' => [
                'userId' => null,
                'topicId' => null
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
        return 'blogs';
    }

    function getTypeName()
    {
        return $this->docTypeName;
    }

    protected $mappingProperties = array(
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'heading' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'content' => [
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

    //tags
    public function tags(){
        return $this->morphToMany('App\Model\Tag', 'taggable');
    }
}
