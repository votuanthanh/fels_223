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
    Route::get('filter-word', 'Web\FilterController@filterWords');
    Route::post('filter-word', 'Web\FilterController@filterWords');
    Route::get('list-user', 'Web\UserController@index');
    Route::get('ajax-relationship-user/{id}', 'Web\UserController@ajaxRelationshipUser');
    Route::get('{id}/edit', 'Web\UserController@edit');
    Route::patch('{id}', 'Web\UserController@update');
});
Route::get('/home', 'HomeController@index');

Route::get('/social/redirect/{provider}', 'Auth\SocialServiceController@getSocialRedirect');
Route::get('/social/handle/{provider}', 'Auth\SocialServiceController@getSocialHandle');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('user', 'Admin\UserController', ['except' => ['store', 'create']]);
});
