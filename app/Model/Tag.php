<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements CRUDable
{
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
