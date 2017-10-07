<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;

class Document extends Model implements CRUDable
{
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
