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


Route::get('/', 'PagesController@index');//->middleware('granted');
Route::resource('/pastatai', 'PastataiController');
Route::resource('/patalpos', 'PatalposController');
Route::resource('/pertvaros', 'PertvarosController');
Route::resource('/vartotojai', 'AssignController');
Route::post('/priskirti/{id}', 'AssignController@assign');
Route::delete('/vartotojai/{idp}/{idu}', 'AssignController@detach');
Route::delete('delete-all', 'PastataiController@deleteAll');
Route::delete('delete-all-patalpas', 'PatalposController@deleteAll');
Route::delete('delete-all-pertvaras', 'PertvarosController@deleteAll');
Route::get('/pertvaros-paieska', 'PertvarosController@search');
Route::get('/patalpos-paieska', 'PatalposController@search');

Route::get('/paieska', 'PastataiController@search');

Auth::routes();

Route::get('/menu', 'HomeController@index')->name('menu');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('unauth', '\App\Http\Controllers\Auth\LoginController@unauth');
