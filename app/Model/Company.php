<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Company extends Model implements CRUDable
{
    use Searchable;
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

    public $documentIndex =  'companies';

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

    //review
    public function reviews(){
        return $this->hasMany('App\Model\Review','companyId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','picturable');
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
