<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/projects/search', 'ProjectController@search')->name('projects.search');
Route::get('/categories/search', 'CategoryController@search')->name('categories.search');
Route::Resource('/projects', 'ProjectController');
Route::get('projects/{id}/cancel', 'ProjectController@cancel')->name('project.cancel');
Route::get('projects/{id}/undo', 'ProjectController@undo')->name('project.undo');
Route::Resource('/categories', 'CategoryController');
Route::get('/send', 'EmailController@send');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout')->name('project.logout');

