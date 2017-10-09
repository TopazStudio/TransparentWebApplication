<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/3/17
 * Time: 7:25 PM
 */

namespace App\Util\CRUD;

use Route;

class RouteUtils
{
    public static function dynamicAddRoutes($prefix,$controller){
        Route::group(['prefix'=>$prefix],function () use($controller) {
            Route::get('/getAll', [
                'uses' => $controller .'@getAll',
            ]);

            Route::get('/get/{id}', [
                'uses' => $controller .'@get',
            ]);

            Route::post('/add', [
                'uses' => $controller .'@add',
            ]);

            Route::put('/{id}', [
                'uses' => $controller .'@update',
            ]);

            Route::delete('/{id}', [
                'uses' => $controller .'@delete',
            ]);

        });
    }
}