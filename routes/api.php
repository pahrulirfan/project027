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

Route::get('password', function () {
    return bcrypt('irfan');
});

Route::get('/tasks', 'TaskController@index')->name('tasks.index');

Route::post('/tasks', 'TaskController@store')->name('tasks.store')->middleware('auth:api');

Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show');

Route::put('/tasks/{task}', 'TaskController@update')->name('tasks.update');

Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('wajib', 'AuthController@wajib');
});
