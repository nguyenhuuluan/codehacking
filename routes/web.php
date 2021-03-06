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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

 
	





// Route::group(['middleware'=>'admin'], function(){

// 	Route::resource('admin/users', 'AdminUsersController');


// });


Route::middleware(['admin', 'web', 'auth'])->group(function () {
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');
    Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');
	//Route::get('admin/media/upload', ['as'=>'media.upload', 'uses'=>'AdminMediasController@store']);


	// Route::resource('admin/comments', 'PostCommentController');
	// Route::resource('admin/comment/replies', 'CommentRepliesController');
	
    Route::get('/admin', function(){
	return view('admin.index');

});
    });
Route::middleware(['web', 'auth'])->group(function () {
  

	Route::resource('admin/comments', 'PostCommentController');
	Route::resource('admin/comment/replies', 'CommentRepliesController');
	

});

Route::middleware(['auth'])->group(function(){

	Route::post('comment/reply', 'CommentRepliesController@createReply');
});



