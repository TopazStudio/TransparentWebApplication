<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/22/2017
 * Time: 9:04 AM
 */

namespace App\Util\CRUD;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HandlesCRUD
{
    use HandlesImages, HasErrorsAndInfo;

    /**
     * Fetch model's CRUD settings
     *
     * @param $key
     * @return mixed
     */
    private function fromSettings($key){
        return (call_user_func([$this->getModelType(),'crudSettings']))[$key];
    }

    /**
     * Fetch model according to the authorized parent. Returns only one model.
     *
     * @param Request $request
     * @param $id
     * @return bool|Model
     */
    private function getModelAccordingToParent(Request $request, $id){
        $model = call_user_func_array([$this->getModelType(),'where'],['id','=',$id]);


        foreach ($this->fromSettings('parentRel') as $key => $value){
            //If request has the parent relationship get it from there
            if ($request->has($key)){
                $model->where($key,'=',$request->{$key});
            }else{
                $model->where($key,'=',$value);
            }
        }

        $model = $model->get()->first();

        if(!$model){
            $this->errors['Not Authorized'] = $id;
            return false;
        }

        return $model;
    }

    /**
     * Used to resolve the relationships of the model. This means fetching
     * the relevant ids of the foreign columns.
     *
     * @param Request $request
     * @return array|bool
     */
    private function resolveRelations(Request $request){
        $rels = array();
        foreach ($this->fromSettings('relationships') as $key => $value) {
            //1. Look in request
            if ($request->has($key)){
                $rels[$key] = $request->{$key};
                continue;
            }
            //2. from settings
            if(is_numeric($value)) {
                $rels[$key] = $value;
                continue;
            }
        }
        return $rels;
    }

    /**
     * Used to resolve a relationships of the model. This means fetching
     * a particular id for the foreign columns
     *
     * @param Request $request
     * @param $key
     * @return bool
     */
    /*private function resolveRelation(Request $request,$key){
        //1. Look in request
        if ($request->has($key))
            return $rels[$key] = $request->{$key};

        //2. from settings
        else
            return ($this->fromSettings('relationships'))[$key];

    }*/

    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param Request $request
     * @internal Model $model
     * @return bool
     */
    public function add(Request $request){
        $model = null;
        $attributes = array_merge(
                        $request->only($this->fromSettings('attributes')),
                        $this->resolveRelations($request)
                      );

        //Add hook before creating
        if(!$this->beforeCreate($request,$attributes,$this->info,$this->errors))
            return empty($this->errors);

        $model = call_user_func([$this->getModelType(),'create'],$attributes);
        if($model){
            $this->info['added'][] = $model->id;
        }else{
            $this->errors['Add']['Add Failed'] = $model->id;
        }

        //Handle images
        if ($this->fromSettings('hasPicture')){
            if($request->hasFile('image')){
                $this->handleImage($request,$model->id);
            } else {
                $this->defaultImage($model->id);
            }
        }

        //Add hook after creating
        if(!$this->afterCreate($request,$model,$this->info,$this->errors))
            return empty($this->errors);

        return empty($this->errors);
    }

    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request,$id){
        //Add hook before update
        if(!$this->beforeUpdate($request,$id,$this->info,$this->errors))
            return empty($this->errors);

        if($model = $this->getModelAccordingToParent($request,$id)) {
            if ($model->update($request->only($this->fromSettings('attributes')))) {
                $this->info['updated'] = $id;
            } else {
                $this->errors['Update']['Not Updated'] = $id;
            }
        }

        //Add hook after update
        if(!$this->afterUpdate($request,$model,$this->info,$this->errors))
            return empty($this->errors);

        return empty($this->errors);
    }

    /**
     * Used to delete a Cuisine owned by the current user,
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function delete(Request $request,$id){
        //Add hook before delete
        if(!$this->beforeDelete($request,$id,$this->info,$this->errors))
            return empty($this->errors);

        if($model = $this->getModelAccordingToParent($request,$id)) {
            if ($model->delete()) {
                $this->info['deleted'] = $id;
            } else {
                $this->errors['Delete']['Delete Failed'] = $id;
            }
        }

        //Add hook after creating
        if(!$this->afterDelete($request,$model,$this->info,$this->errors))
            return empty($this->errors);

        return empty($this->errors);
    }

    /**
     * Fetch all Models without any restriction.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @internal param $id
     */
    public function getAll(){
        try{
            return call_user_func([$this->getModelType(),'all']);
        }catch (\Exception $e){
            $this->errors['Get']['Get Failed'] = $e->getMessage();
            return $this->errors;
        }
    }

    /**
     * Fetch a Model without any restriction.
     *
     * @param $id
     * @return array|Model
     */
    public function get($id){
        try{
            return call_user_func_array([$this->getModelType(),'where'],['id','=',$id])->get();
        }catch (\Exception $e){
            $this->errors['Get']['Get Failed'] = $e->getMessage();
            return $this->errors;
        }
    }

    //HOOKS
    public function beforeCreate($request,$attributes){
        //
        return true;
    }

    public function afterCreate($request,$model){
        //
        return true;
    }

    public function beforeUpdate($request,$attributes){
        //
        return true;
    }

    public function afterUpdate($request,$model){
        //
        return true;
    }

    public function beforeDelete($request,$attributes){
        //
        return true;
    }

    public function afterDelete($request,$model){
        //
        return true;
    }
}