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

Auth::routes();
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('category', 'Web\CategoryController@index');
    Route::get('lesson/category/{id}', 'Web\LessonController@index');
    Route::post('result', 'Web\ResultController@store');
});
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('user', 'Admin\UserController', ['except' => ['store', 'create']]);
});
