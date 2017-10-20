<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Document extends Model implements CRUDable
{
    use ElasticquentTrait;
//CRUD
    protected $fillable = [
        'location',
        'name',
        'description',
        'type',
        'size',
        'companyId',
        'userId'
    ];

    public static function crudSettings()
    {
        return[
            'hasPicture'=>false,
            'attributes' => [
                'location',
                'name',
                'description',
                'type',
                'size',
            ],
            'relationships' => [
                'companyId' => null,
                'userId' => null
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
        return 'documentz';
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

//RELATIONSHIPS
    //user
    public function user(){
        return $this->belongsTo('App\Model\User','userId');
    }

    //company
    public function company(){
        return $this->belongsTo('App\Model\Company','companyId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','pic');
    }
}
