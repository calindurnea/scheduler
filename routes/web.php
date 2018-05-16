<?php

use App\Events\MessagePosted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('shifts/sendmail', ['as' => 'shifts.sendmail', 'uses' => 'ShiftController@sendMail']);

//chat
Route::get('chat', 'ChatsController@index');
Route::get('chat/messages', 'ChatsController@fetchMessages');
Route::post('chat/messages', 'ChatsController@sendMessage');

//users
Route::get('users/shifts', ['as' => 'users.getShifts', 'uses' => 'UserController@getShifts']);

Route::resource('users', 'UserController');

Route::resource('users', 'UserController', [
    'except' => ['index', 'show', 'getShifts'],
])->middleware('manager');

//shifts
Route::resource('shifts', 'ShiftController');

Route::resource('shifts', 'ShiftController', [
    'except' => ['index', 'show'],
])->middleware('manager');

Route::post('shifts/store', ['as' => 'shifts.store', 'uses' => 'ShiftController@store']);
//colors
Route::resource('colors', 'ColorController')->middleware('manager');

//schedule
Route::resource('schedules', 'ScheduleController');

Route::resource('schedules', 'ScheduleController', [
    'except' => ['index', 'show'],
])->middleware('manager');