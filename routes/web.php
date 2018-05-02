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
	
	Route::get('/', 'Controller@index')->name('index');
	
	Route::post('contacts', 'Controller@contactRequest')->name('contacts');
	
	Route::group([
		'prefix' => 'administrator/',
		'as'     => 'admin::',
	], function () {
		
		Route::get('/', 'AdministratorController@index')->name('index');
		
		Route::group([
			'prefix' => 'rooms/',
			'as'     => 'rooms::',
		], function () {
			Route::get('/', 'RoomsController@index')->name('index');
			Route::get('/create', 'RoomsController@create')->name('create');
			Route::get('/edit/{id}', 'RoomsController@edit')->name('edit');
			Route::post('/save', 'RoomsController@save')->name('save');
			Route::get('/delete/{id}', 'RoomsController@delete')->name('delete');
		});
		
		
	});
	
	Auth::routes();

