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


Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');
    Route::get('tasks/{id}', 'TaskController@ForOneTask');

    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::put('task/{id}' ,'TaskController@update' );
    Route::delete('/task/{id}', 'TaskController@destroy');
    Route::put('tasks/{task}', 'TaskController@markAsCompleted');
    Route::auth();
});

