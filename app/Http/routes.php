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

Route::group(['middleware' => ['web']], function () {

	// Authentication routes...
	Route::resource('login','AuthController');
	Route::get('logout','AuthController@logout');

	// Reset Password routes...
	Route::get('password/email','Auth\PasswordController@getEmail');
	Route::post('password/email','Auth\PasswordController@postEmail');

	Route::get('password/reset/{token}','Auth\PasswordController@getReset');
	Route::post('password/reset','Auth\PasswordController@postReset');

	// Index
	Route::resource('/','IndexController');
	Route::resource('/customer-search','CustomerSearchController');
	// Document
	Route::post('/document/getpreguide','DocumentController@getpreguide');
	Route::post('/document/setpreguide','DocumentController@setpreguide');

	// Listas dinámicas
	Route::get('cities/{code}','DynamicListsController@cities');
	Route::get('postal-code-colonies/{code}','DynamicListsController@postalcodes');
	Route::get('postal-code-state/{code}','DynamicListsController@state');

	// Ejecución de extract y match
	Route::get('/match', function () {
	    return view('match/extract-match');
	});
	Route::get('extract-process','ExtractMatchController@import');
	Route::post('match-process','ExtractMatchController@match');

	// Registro Maestro...
	Route::get('master-record/create-customer','MasterRecordController@createcustomer');
	Route::post('master-record/store-customer','MasterRecordController@storecustomer');
	Route::resource('master-record','MasterRecordController');

	// Possible Match...
	Route::get('possible-match/{id}/link','PossibleMatchController@link');
	Route::resource('possible-match','PossibleMatchController');

	// Users
	Route::resource('users','UserController');

	// Language...
    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);
});