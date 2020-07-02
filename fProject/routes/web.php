<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@loginView')->name('login.view');

Route::post('/signin/excute', 'Auth\LoginController@signinExe')->name('login.excute');
Route::get('/main', 'Auth\LoginController@main')->name('main');

Route::middleware('auth.code')->group(function(){
	Route::post('/signout/excute', 'Auth\LoginController@signoutExe')->name('logout.excute');
	Route::post('/action/request', 'ActionController@index')->name('action.exe');
});
