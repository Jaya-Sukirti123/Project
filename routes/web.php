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
Route::Resource('/categories', 'CategoryController');







