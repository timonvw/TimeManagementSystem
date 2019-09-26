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

//short version
Route::resource('projects', 'PagesController');

//long version
// Route::get('/projects', 'PagesController@index');
// Route::get('/projects/create', "PagesController@create");
// Route::post('/projects/create', "PagesController@store");
// Route::get('/projects/{project}', "PagesController@show");
// Route::get('/projects/{project}/edit', "PagesController@edit");
// Route::patch('/projects/{project}', "PagesController@update");
// Route::delete('/projects/{project}', "PagesController@destroy");

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
