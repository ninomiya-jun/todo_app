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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/index', 'TasksController@index');
    Route::get('/tasks/{task}', 'TasksController@show')->where('task', '[0-9]+');
    Route::get('/tasks/create', 'TasksController@create');
    Route::post('/tasks', 'TasksController@store');
    Route::get('/tasks/{task}/edit', 'TasksController@edit');
    Route::patch('/tasks/{task}', 'TasksController@update');
    Route::delete('/tasks/{task}', 'TasksController@destroy');
    Route::patch('/tasks/{task}', 'TasksController@finish');

    Route::get('/tag/{tag}', 'TagsController@show')->where('tag', '[0-9]+');
    Route::get('/tags/create', 'TagsController@create');
    Route::post('/tags', 'TagsController@store');
    Route::delete('/tags/{tag}', 'TagsController@destroy');

    Route::post('/tasks/{task}/comments', 'CommentsController@store');
    Route::delete('/tasks/{task}/comments/{comment}', 'CommentsController@destroy');
});