<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/23/17
 * Time: 3:52 PM
 */

namespace App\Traits;


use Exception;
use GraphQL\Type\Definition\Type;

trait DoesGraphqlResponse
{
    //TODO: handle errors and validation errors
    private function Add(){
        if ($model = $this->gqlAdd($this->request)['Add']['Successful']){
            return $model;
        }else return null;
    }

    private function Delete(){
        if ($model = $this->gqlAdd($this->request)['Delete']['Successful']){
            return $model;
        }else return null;
    }

    private function Update(){
        if ($model = $this->gqlAdd($this->request)['Update']['Successful']){
            return $model;
        }else return null;
    }


    /**
     * Available arguments on mutation.
     *
     * @return array
     */
    public function args()
    {
        return [
            'type' => [
                'type' => Type::string()
            ],
            'raw' => [
                'type' => Type::string()
            ]
        ];
    }

    /**
     * Resolve the mutation.
     *
     * @param  mixed $root
     * @param  array  $args
     * @return mixed
     */
    public function resolve($root, array $args)
    {
        $raw = json_decode($args['raw'],true);

        $this->request->merge($raw);

        $fn = $args['type'];

        return $this->$fn();

        try{
            return $this->$args['type']();
        }catch (Exception $e){
            return $e;
        }

    }
}