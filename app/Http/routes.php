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


//HomeController
Route::group(['middleware' =>'auth'], function()
{
    Route::get('/', 'home\HomeController@index');
    Route::get('home', 'home\HomeController@index');
    
    

});

//BlogController
Route::group(['middleware' =>'auth','prefix'=>'blog'], function(){

    Route::get('lists', 'home\BlogController@lists');
    Route::get('index', 'home\BlogController@index');
    Route::post('deliverBlog', 'home\BlogController@deliverBlog');
    Route::get('deleteBlog/{id}', 'home\BlogController@deleteBlog');
    Route::get('editBlog/{id}', 'home\BlogController@editBlogIndex');
    Route::post('editBlog/{id}', 'home\BlogController@editBlog');
    Route::get('blogMore/{id}', 'home\BlogController@blogMore');
});

//CategoryController
Route::group(['middleware' =>'auth','prefix'=>'category'], function(){

    Route::get('index', 'home\CategoryController@index');
    Route::post('add', 'home\CategoryController@add');
    Route::get('delete/{id}', 'home\CategoryController@delete');

});

//CommentController
Route::group(['middleware' =>'auth','prefix'=>'comment'], function(){

    Route::get('/index', 'home\CommentController@index');
    Route::get('/delete/{id}', 'home\CommentController@delete');
    Route::post('/deliver/{id}', 'home\CommentController@deliver');

});

//PersonalController
Route::group(['middleware' =>'auth','prefix'=>'personal'], function(){

    Route::get('profile', 'home\PersonalController@profile');
    Route::post('upform', 'home\PersonalController@face');
    Route::post('updata', 'home\PersonalController@updata');
    Route::get('index', 'home\PersonalController@index');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
