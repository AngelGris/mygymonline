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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/users/', ['as' => 'users', 'uses' => 'UsersController@index']);
Route::get('/plans/', ['as' => 'plans', 'uses' => 'PlansController@index']);