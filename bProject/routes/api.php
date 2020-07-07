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

Route::post('sigin/excute', 'CodeApiController@getCode');
Route::post('sigin/checking', 'CodeApiController@checking');

Route::middleware('auth.apicode')->group(function(){
	Route::post('menu/call', 'CodeApiController@menuCall');
	Route::post('view/data', 'CodeApiController@viewData');
	Route::post('find/data', 'CodeApiController@find');
	Route::post('get/data', 'CodeApiController@getData');
	Route::post('index/data', 'CodeApiController@indexData');
	Route::post('store/data', 'CodeApiController@storeData');
	Route::post('destroy/data', 'CodeApiController@destroyData');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
