<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements CRUDable
{
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
}
