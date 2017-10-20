<?php

use Sleimanx2\Plastic\Map\Blueprint;
use Sleimanx2\Plastic\Mappings\Mapping;

class AppModelUser extends Mapping
{
    /**
     * Full name of the model that should be mapped
     *
     * @var string
     */
    protected $model = App\Model\User::class;

    /**
     * Run the mapping.
     *
     * @return void
     */
    public function map()
    {
        Map::create($this->getModelType(),function(Blueprint $map){
            $map->string('name',['store'=>'true','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('email',['store'=>'true','index'=>'analyzed','analyzer' => 'standard',]);
            $map->string('role',['store'=>'true','index'=>'analyzed','analyzer' => 'standard',]);

        },$this->getModelIndex());
    }
}
