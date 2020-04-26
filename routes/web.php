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
    return view('index');
})->name('beforeLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum/search', 'ForumController@search')->name('forumsearch');
Route::resource('/forum', 'ForumController');

// Route::get('/forum', 'ForumController@index')->name('forum');

Route::get('/forum/read/{slug}', 'ForumController@show')->name('forumslug');


Route::post('/comment/addComment/{forum}', 'CommentController@addComment')->name('addComment');
Route::post('/comment/replyComment/{comment}', 'CommentController@replyComment')->name('replyComment');

Route::get('/populars', 'ForumController@populars')->name('populars');
Route::get('/user/{user}', 'ProfileController@index')->name('profile');
Route::get('/user/edit/{user}', 'ProfileController@edit')->name('profileEdit');
Route::put('/user/update/{user}', 'ProfileController@update')->name('profileUpdate');

Route::resource('/tag', 'TagController');
