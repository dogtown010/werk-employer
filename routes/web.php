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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', 'EmployersController@index');

Route::post('/add', 'EmployersController@store');

Route::get('/edit/{id}', 'EmployersController@edit');

Route::get('/delete/{id}', 'EmployersController@delete');

Route::post('processEdit', 'EmployersController@processEdit');

Route::get('/export', 'EmployersController@export');

Route::get('/import', 'EmployersController@import');

Route::post('processImport', 'EmployersController@processImport');

Route::post('search', 'EmployersController@search');

Route::get('format', 'EmployersController@format');