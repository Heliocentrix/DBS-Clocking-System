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

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
Route::get('/admin/auth/login', 'Auth\AuthController@getAdminLogin');

Route::resource('/admin', 'AdminUsersController');


Route::post('/signin', 'WebController@signIn');
Route::post('/viewdate', 'WebController@changeDate');
Route::post('/edittimes', 'Webcontroller@editTimes');
Route::post('/addjob', 'WebController@processAddJob');

Route::get('/', 'WebController@index');
Route::get('/addjob', 'WebController@addJob');
Route::get('/{date}', 'WebController@showDate');
