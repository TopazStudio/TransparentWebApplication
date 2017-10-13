<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/11/17
 * Time: 7:05 PM
 */

namespace App\Services\User;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements CRUDService
{
    use HandlesCRUD;

    /**
     * Initialize pic-path and pic-type
     */
    public function __construct(){

        $this->picType = 'userPic';

        $this->picPath = 'userPics';
    }

    public function getModelType()
    {
        return 'App\Model\User';
    }

    /**
     * Register User
     *
     * @param Request $request
     * @return bool
     */
    public function add(Request $request){
        $model = null;
        $attributes = array_merge(
            $request->only($this->fromSettings('attributes')),
            $this->resolveRelations($request)
        );

        $model = call_user_func([$this->getModelType(),'create'],[
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
            'role' => $attributes['role']
        ]);

        if($model){
            $this->info['registered']['user'] = $model;
        }else{
            $this->errors['registry'] = 'registry_failed';
        }

        //Handle images
        if ($this->fromSettings('hasPicture')){
            if($request->has('image')){
                $this->saveImageFromTemp($request,$model->id);
            } else {
                $this->defaultImage($model->id);
            }
        }

        return empty($this->errors);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function afterCreate($request, $model){
        event(new Registered($model));
        return true;
    }
}