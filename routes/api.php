<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth::routes();
Route::group(['prefix'=>'/auth', 'middleware'=>['web']],function () {
    Route::post('/login', [
        'uses' => 'Auth\LoginController@login',
    ]);

    Route::post('/logout', [
        'uses' => 'Auth\LoginController@logout',
    ]);

    Route::post('/register', [
        'uses' => 'Auth\RegisterController@add',
    ]);

});

Route::post('/temp/image',[
    'uses' => 'TempController@storeTempPic',
]);

Route::group(['prefix'=>'/search', 'middleware'=>['web']],function () {
    Route::get('/{entity}/index',[
        'uses'=>'SearchController@index'
    ]);

    Route::post('/{entity}/complex',[
        'uses'=>'SearchController@complex'
    ]);

    Route::get('/{entity}/simple/{term}',[
        'uses'=>'SearchController@simple'
    ]);

});
//\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/user','Blog\BlogController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/blog','Blog\BlogController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/topic','Topic\TopicController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/comment','Topic\CommentController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/company','Company\CompanyController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/review','Company\ReviewController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/reply','Topic\ReplyController',['auth.jwt']);
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/tag','TagController',['auth.jwt']);