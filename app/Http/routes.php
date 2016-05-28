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
    Route::get('/profile', 'home\HomeController@profile');
    Route::post('/upform', 'home\HomeController@face');
    Route::post('/updata', 'home\HomeController@updata');
    
    Route::get('/personal', 'home\HomeController@personal');
    Route::get('/comment', 'home\HomeController@comment');
    Route::get('/category', 'home\HomeController@category');
    Route::post('/addCate', 'home\HomeController@addCate');
    Route::get('/deleteCate/{id}', 'home\HomeController@deleteCate');
    
    
    
    Route::post('/deliverComment/{id}', 'home\HomeController@deliverComment');

});

//BlogController
Route::group(['middleware' =>'auth','prefix'=>'blog'], function(){

    Route::get('lists', 'home\BlogController@lists');
    Route::get('blog', 'home\BlogController@blog');
    Route::post('deliverBlog', 'home\BlogController@deliverBlog');
    Route::get('deleteBlog/{id}', 'home\BlogController@deleteBlog');
    Route::get('editBlog/{id}', 'home\BlogController@editBlogIndex');
    Route::post('/editBlog/{id}', 'home\BlogController@editBlog');
    Route::get('/blogMore/{id}', 'home\BlogController@blogMore');
});

//CategoryController
Route::group(['middleware' =>'auth','prefix'=>'category'], function(){

});

//CommentController
Route::group(['middleware' =>'auth','prefix'=>'comment'], function(){

});

//PersonalController
Route::group(['middleware' =>'auth','prefix'=>'personal'], function(){

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
