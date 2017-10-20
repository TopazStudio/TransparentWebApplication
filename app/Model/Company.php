<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements CRUDable
{
    use ElasticquentTrait;
//CRUD

    protected $fillable = [
        'name',
        'businessNo',
        'description',
        'latitude',
        'longitude',
    ];

    public static function crudSettings()
    {
        return[
            'hasPicture'=>true,
            'attributes' => [
                'name',
                'businessNo',
                'description',
                'latitude',
                'longitude',
            ],
            'relationships' => [],
            'parentRel' => []
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
        return 'companies';
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
        'businessNo' => [
            'type' => 'integer',
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

//RELATIONSHIPS

    //review
    public function reviews(){
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
