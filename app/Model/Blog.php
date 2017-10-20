<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Blog extends Model implements CRUDable
{
    use Searchable;
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

    public $documentIndex =  'blogs';

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
