<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/20/17
 * Time: 9:31 AM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Index the entities in storage for searching.
     *
     * @param $entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($entity){
        if (call_user_func(['App\\Model\\' . $entity,'index'])){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    /**
     * Do a complex search on the entity
     *
     * @param $entity
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function complex($entity,Request $request){
        if ($foods = call_user_func(['App\\Model\\' . $entity,'complexSearch'],$request->all())){
            return response()->json([
                'took' => $foods->took(),
                'totalHits' => $foods->totalHits(),
                'hits'=>$foods->all(),
                'aggr' => $foods->getAggregations(),
            ]);
        }
        return $this->errorResponse();
    }

    /**
     * Do a simple search on the entity
     *
     * @param $entity
     * @param $term
     * @return \Illuminate\Http\JsonResponse
     */
    public function simple($entity,$term){
        //TODO: fix simple search
        if ($foods = call_user_func(['App\\Model\\' . $entity,'search'],$term)){
            return response()->json([
                'took' => $foods->took(),
                'totalHits' => $foods->totalHits(),
                'hits'=>$foods->all(),
            ]);
        }
        return $this->errorResponse();
    }
}