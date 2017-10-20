<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Tag extends Model implements CRUDable{

    use Searchable;

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

    public $documentIndex =  'tags';

    public static $types = null;

    public static function index(){
        foreach (static::all() as $model){
            $model->document()->save();
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
