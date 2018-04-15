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

Route::group(['prefix' => 'user'], function() {
    Route::post('/', 'UsersController@save');
    Route::patch('/', 'UsersController@update');
    Route::delete('/', 'UsersController@delete');

    Route::group(['prefix' => 'plan'], function() {
        Route::get('/', 'UsersController@listPlans');
        Route::post('/', 'UsersController@savePlans');
    });
});

Route::group(['prefix' => 'plan'], function() {
    Route::post('/', 'PlansController@save');
    Route::patch('/', 'PlansController@update');
    Route::delete('/', 'PlansController@delete');

    Route::group(['prefix' => 'day'], function() {
        Route::get('/', 'DaysController@load');
        Route::post('/', 'DaysController@save');
        Route::patch('/', 'DaysController@update');
        Route::delete('/', 'DaysController@delete');

        Route::group(['prefix' => 'exercise'], function() {
            Route::post('/', 'ExercisesController@save');
            Route::delete('/', 'ExercisesController@delete');
        });
    });
});