<?php

namespace App\Services\Company;

use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use App\Util\CRUD\HandlesGraphQLCRUD;
use Illuminate\Http\Request;

class CompanyService implements CRUDService
{
    use HandlesCRUD,HandlesGraphQLCRUD;

    public function __construct(){
        $this->picType = 'companyPic';
        $this->picPath = 'companyPic';
    }

    public function getModelType()
    {
        return 'App\Model\Company';
    }

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
        if(!$this->beforeCreate($request,$attributes))
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
                $this->saveImageFromTemp($request,$model->id);
            } else {
                $this->defaultImage($model->id);
            }
        }

        //Add hook after creating
        if(!$this->afterCreate($request,$model))
            return empty($this->errors);

        return empty($this->errors);
    }

    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param Request $request
     * @return bool
     * @internal Model $model
     */
    public function gqlAdd(Request $request){
        $model = null;
        $attributes = array_merge(
            $request->only($this->fromSettings('attributes')),
            $this->resolveRelations($request)
        );

        //Add hook before creating
        if(!$this->beforeCreate($request,$attributes))
            return empty($this->errors);

        $model = call_user_func([$this->getModelType(),'create'],$attributes);
        if($model){
            $this->info['Add']['Successful'] = $model;
        }else{
            $this->errors['Add']['Failed'] = $model;
        }

        //Handle images
        if ($this->fromSettings('hasPicture')){
            if($request->hasFile('image')){
                $this->saveImageFromTemp($request,$model->id);
            } else {
                $this->defaultImage($model->id);
            }
        }

        //Add hook after creating
        if(!$this->afterCreate($request,$model))
            return empty($this->errors);

        return empty($this->errors);
    }
}
