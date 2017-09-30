<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 9/30/17
 * Time: 2:13 PM
 */

namespace App\Util\CRUD;

use App\Traits\DoesResponses;
use Illuminate\Http\Request;

trait HandlesCRUDRequest
{
    use DoesResponses;

    protected $CRUDService;

    protected $validationRules;

    /**
     * Fetch all Models without any restriction.
     *
     * @return \Illuminate\Http\JsonResponse
     * @internal param $id
     */
    public function getAll(){
        return $this->successResponse($this->CRUDService->getAll());
    }

    /**
     * Fetch a Model without any restriction.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id){
        return $this->successResponse($this->CRUDService->get($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request){
        $this->validate($request,$this->validationRules);

        if($this->CRUDService->add($request)){
            return $this->successResponse($this->CRUDService->info);
        }else{
            return $this->errorResponse($this->CRUDService->errors,$this->CRUDService->info);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,$this->validationRules);

        if($this->CRUDService->update($request,$id)){
            return $this->successResponse($this->CRUDService->info);
        }else{
            return $this->errorResponse($this->CRUDService->errors,$this->CRUDService->info);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        if($this->CRUDService->delete($id)){
            return $this->successResponse($this->CRUDService->info);
        }else{
            return $this->errorResponse($this->CRUDService->errors,$this->CRUDService->info);
        }
    }



}