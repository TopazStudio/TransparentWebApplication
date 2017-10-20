<?php

use Sleimanx2\Plastic\Map\Blueprint;
use Sleimanx2\Plastic\Mappings\Mapping;

class AppModelDocument extends Mapping
{
    /**
     * Full name of the model that should be mapped
     *
     * @var string
     */
    protected $model = App\Model\Document::class;

    /**
     * Run the mapping.
     *
     * @return void
     */
    public function map()
    {
        Map::create($this->getModelType(),function(Blueprint $map){
            $map->string('name',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('description',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);

        },$this->getModelIndex());
    }
}
