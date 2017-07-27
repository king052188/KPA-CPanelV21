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

Route::get('/members/{type}', 'ApiController@member_populate');

Route::post('/request/token', 'ApiController@cookies');

Route::post('/package/plan/create', 'ApiController@create_package_plan');

Route::post('/package/plan/verify', 'ApiController@get_package_status');

Route::post('/disk/create', 'ApiController@create_disk');

Route::post('/web/app/install', 'ApiController@install_webApp');

Route::post('/web/create', 'ApiController@create_web');

Route::post('/web/site/state', 'ApiController@web_state_update');

Route::post('/web/site/status', 'ApiController@get_state_status');

Route::post('/ftp/create', 'ApiController@create_ftp');

Route::get('/remote/engine', 'ApiController@get_remote_engine_api');