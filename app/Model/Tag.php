<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements CRUDable{

    use ElasticquentTrait;

//CRUD
    //TODO:avoid orphaning of tags
    protected $fillable = [
        'name'
    ];

    //Company and User are loaded from frontend
    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'name'
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
        return 'tags';
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
    //topics
    public function topics()
    {
        return $this->morphedByMany('App\Model\Topic', 'taggable');
    }

    //blogs
    public function blogs()
    {
        return $this->morphedByMany('App\Model\Blog', 'taggable');
    }


}
