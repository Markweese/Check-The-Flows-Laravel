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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'states'], function() {
  Route::get('/', 'StateController@index');
  Route::get('/{state}', 'StateController@show');
});

Route::group(['prefix' => 'stations'], function() {
  Route::get('/', 'StationController@index');
  Route::get('/{station}', 'StationController@show');
});
