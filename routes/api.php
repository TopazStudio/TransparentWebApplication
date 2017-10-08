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

\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/blog','Blog\BlogController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/topic','Topic\TopicController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/comment','Topic\CommentController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/company','Company\CompanyController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/review','Company\ReviewController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/reply','Topic\ReplyController');
\App\Util\CRUD\RouteUtils::dynamicAddRoutes('/tag','TagController');