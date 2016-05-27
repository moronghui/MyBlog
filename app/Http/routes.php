<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::group(['middleware' =>'auth'], function()
{
    Route::get('/', 'home\HomeController@index');
    Route::get('home', 'home\HomeController@index');
    Route::get('/profile', 'home\HomeController@profile');
    Route::post('/upform', 'home\HomeController@face');
    Route::post('/updata', 'home\HomeController@updata');
    Route::get('/lists', 'home\HomeController@lists');
    Route::get('/blog', 'home\HomeController@blog');
    Route::post('/deliverBlog', 'home\HomeController@deliverBlog');
    Route::get('/personal', 'home\HomeController@personal');
    Route::get('/comment', 'home\HomeController@comment');
    Route::get('/category', 'home\HomeController@category');
    Route::post('/addCate', 'home\HomeController@addCate');
    Route::get('/deleteCate/{id}', 'home\HomeController@deleteCate');
    Route::get('/deleteBlog/{id}', 'home\HomeController@deleteBlog');
    Route::get('/editBlog/{id}', 'home\HomeController@editBlogIndex');
    Route::post('/editBlog/{id}', 'home\HomeController@editBlog');
    Route::get('/blogMore/{id}', 'home\HomeController@blogMore');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
