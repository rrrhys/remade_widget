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



//Route::get('/widget/{widget_token}', 'WidgetController@to_user');
Route::get('widget/js/{widget_token}', 'WidgetController@initjs');
Route::get('widget/test_page/{widget_token}','WidgetController@test_page');
Route::post('widget/update_stats/{widget_token}','WidgetController@update_stats');

Route::get('/user/settings', 'UserController@settings');
Route::post('/user/settings', 'UserController@storeSettings');


Route::resource('user','UserController');
Route::get('/user/send_child_password_reset/{id}','UserController@send_child_password_reset')->where('id','[0-9]+');
Route::get('/user/password_reset/{token}','UserController@password_reset');
Route::post('/user/save_new_password','UserController@save_new_password');


Route::post('signin','SessionController@create');
Route::get('signout','SessionController@destroy');
