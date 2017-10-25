<?php

use Sleimanx2\Plastic\Map\Blueprint;
use Sleimanx2\Plastic\Mappings\Mapping;

class AppModelCompany extends Mapping
{
    /**
     * Full name of the model that should be mapped
     *
     * @var string
     */
    protected $model = App\Model\Company::class;

    /**
     * Run the mapping.
     *
     * @return void
     */
    public function map()
    {
        Map::create($this->getModelType(),function(Blueprint $map){
            $map->string('name',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->integer('businessNo',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('description',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->double('latitude',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);
            $map->double('longitude',['store'=>'false','index'=>'analyzed','analyzer' => 'standard',]);

        },$this->getModelIndex());
    }
}
