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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//COMPANY
Route::group(['prefix'=>'/company'],function (){
    Route::get('/getAll', [
        'uses' => 'Company\CompanyController@getAll',
    ]);

    Route::get('/get/{id}', [
        'uses' => 'Company\CompanyController@get',
    ]);

    Route::post('/add', [
        'uses' => 'Company\CompanyController@add',
    ]);

    Route::put('/{id}', [
        'uses' => 'Company\CompanyController@update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'Company\CompanyController@delete',
    ]);
});