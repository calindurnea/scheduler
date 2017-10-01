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

Route::get('/', function() {
	return view('welcome');
});

Auth::routes();

Route::get('/users', ['as' => 'users_show', 'uses' => 'UserController@index']);
Route::post('/user', ['as' => 'user_show', 'uses' => 'UserController@show']);

Route::get('/user/create', ['as' => 'user_create', 'uses' => 'UserController@create']);
Route::post('/user/store', ['as' => 'user_store', 'uses' => 'UserController@store']);

Route::post('/user/edit', ['as' => 'user_edit', 'uses' => 'UserController@edit']);

Route::get('/schedule', ['as' => 'schedule_show', 'uses' => 'ShiftController@index']);