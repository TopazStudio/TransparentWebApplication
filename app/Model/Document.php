<?php

namespace App\Model;

use App\Util\CRUD\CRUDable;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Document extends Model implements CRUDable
{
    use Searchable;
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

    public $documentIndex =  'documents';

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

    //company
    public function company(){
        return $this->belongsTo('App\Model\Company','companyId');
    }

    //picture
    public function pictures(){
        return $this->morphMany('App\Model\Picture','pic');
    }
}
