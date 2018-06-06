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

Route::get('/', function () {
    return view('welcome');
});
Route::get('get/once', function () {
    return view('once');
});
Route::post('once', 'OnceController@index');
Route::get('caculate/equaly/{city}', 'CaculateController@index')
    ->where('city', '[0-9]+');
Route::get('caculate/equaly/head-only/{city}', 'CaculateController@headOnly')
    ->where('city', '[0-9]+');
Route::get('record/{city}', 'RecordController@index')
    ->where('city', '[0-9]+');
Route::get('update', 'UpdateController@index');
Route::post('update', 'UpdateController@index');
