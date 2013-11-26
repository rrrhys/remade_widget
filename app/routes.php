<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'UserController@show');

Route::resource('user','UserController');
Route::get('/user/child_password_reset/{id}','UserController@child_password_reset')->where('id','[0-9]+');


Route::post('signin','SessionController@create');
Route::get('signout','SessionController@destroy');