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
Route::resource('/projects', 'PagesController');
Route::resource('/home', 'HomeController');
Route::resource('/tasks', 'TasksController');
Route::resource('/groups', 'Groupscontroller');
Route::resource('/user', 'UserController');

//long version
// Route::get('/projects', 'PagesController@index');
// Route::get('/projects/create', "PagesController@create");
// Route::post('/projects/create', "PagesController@store");
// Route::get('/projects/{project}', "PagesController@show");
// Route::get('/projects/{project}/edit', "PagesController@edit");
// Route::patch('/projects/{project}', "PagesController@update");
// Route::delete('/projects/{project}', "PagesController@destroy");

Route::get('/', function () {
    return view('homepage');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout');
Route::get('/tasks', 'TasksController@index')->name('tasks');
Route::get('/groups', 'GroupsController@index')->name('groups');
Route::get('/user', 'UserController@index')->name('user');

Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');
