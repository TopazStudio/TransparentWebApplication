<?php

use Sleimanx2\Plastic\Map\Blueprint;
use Sleimanx2\Plastic\Mappings\Mapping;

class AppModelBlog extends Mapping
{
    /**
     * Full name of the model that should be mapped
     *
     * @var string
     */
    protected $model = App\Model\Blog::class;

    /**
     * Run the mapping.
     *
     * @return void
     */
    public function map()
    {
        Map::create($this->getModelType(),function(Blueprint $map){
            $map->string('url',['store'=>'true','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('heading',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('content',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);

        },$this->getModelIndex());
    }
}
