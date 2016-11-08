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

	Route::resource('/','IndexController');

	Route::resource('/customer-search','CustomerSearchController');

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

	// Language...
    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);
});