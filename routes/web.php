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

Route::get('/', 'PagesController@index');
Route::resource('/pastatai', 'PastataiController');
Route::resource('/patalpos', 'PatalposController');
Route::resource('/pertvaros', 'PertvarosController');
Route::get('/paieska', 'PastataiController@search');
Route::delete('delete-all', 'PastataiController@deleteAll');
Route::delete('delete-all-patalpas', 'PatalposController@deleteAll');
Route::delete('delete-all-pertvaras', 'PertvarosController@deleteAll');
Route::get('/pertvaros-paieska', 'PertvarosController@search');
Route::get('/patalpos-paieska', 'PatalposController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
