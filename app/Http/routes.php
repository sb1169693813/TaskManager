<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@welcome');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('projects','ProjectsController');
Route::post('tasks/{id}/check','TasksController@check')->name('tasks.check');
Route::resource('tasks','TasksController');
//双重路由
Route::resource('tasks.steps','StepsController');
