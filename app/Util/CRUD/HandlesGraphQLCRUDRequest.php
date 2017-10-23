<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/23/17
 * Time: 2:21 PM
 */

namespace App\Util\CRUD;


use Illuminate\Http\Request;

trait HandlesGraphQLCRUDRequest
{
    protected $CRUDService;

    //TODO: make dynamic adding and updating validation rules
    protected $addValidationRules;
    protected $updateValidationRules;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gqlAdd(Request $request){
//        $this->validate($request,$this->addValidationRules);

        if($this->CRUDService->gqlAdd($request)){
            return $this->CRUDService->info;
        }else{
            return $this->CRUDService->errors;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function gqlUpdate(Request $request, $id)
    {
//        $this->validate($request,$this->updateValidationRules);

        if($this->CRUDService->gqlUpdate($request,$id)){
            return $this->CRUDService->info;
        }else{
            return $this->CRUDService->errors;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function gqlDelete(Request $request,$id){
        if($this->CRUDService->gqlDelete($request, $id)){
            return $this->CRUDService->info;
        }else{
            return $this->CRUDService->errors;
        }
    }

}