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

Route::resource('/','IndexController');

// Listas dinámicas
Route::get('cities/{code}','DynamicListsController@cities');

// Ejecución de extract y match
Route::get('/match', function () {
    return view('match/extract-match');
});
Route::get('extract-process','ExtractMatchController@import');
Route::post('match-process','ExtractMatchController@match');

Route::resource('master-record','MasterRecordController');