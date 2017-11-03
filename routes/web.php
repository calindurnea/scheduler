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

Route::get('/users', ['as' => 'users_get', 'uses' => 'UserController@index']);
Route::post('/user', ['as' => 'users_show', 'uses' => 'UserController@show']);

Route::get('/users/create', ['as' => 'users_create', 'uses' => 'UserController@create']);
Route::post('/users/store', ['as' => 'users_store', 'uses' => 'UserController@store']);
//Route::post('/users/edit', ['as' => 'user_edit', 'uses' => 'UserController@edit']);
//Route::post('/users/update', ['as' => 'user_update', 'uses' => 'UserController@update']);
Route::post('/users/delete', ['as' => 'users_delete', 'uses' => 'UserController@destroy']);


Route::get('/shifts', ['as' => 'shifts_get', 'uses' => 'ShiftController@index']);
Route::post('/shifts/show', ['as' => 'shifts_show', 'uses' => 'ShiftController@show']);
Route::post('/shifts/store', ['as' => 'shifts_store', 'uses' => 'ShiftController@store']);

Route::get('/schedule', ['as' => 'schedule_get', 'uses' => 'ScheduleController@index']);

//Route::get('/schedule/edit', ['as' => 'schedule_edit', 'uses' => 'ScheduleController@edit']);
//Route::post('/schedule/update', ['as' => 'schedule_update', 'uses' => 'ScheduleController@update']);

Route::get('/colors', ['as' => 'colors_get', 'uses' => 'ColorController@index']);
Route::post('/colors/store', ['as'=>'colors_store', 'uses'=>'ColorController@store']);
Route::post('/colors/delete', ['as'=>'colors_delete', 'uses'=>'ColorController@destroy']);