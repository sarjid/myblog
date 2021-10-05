<?php

use App\Category;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\CommentController;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Mail\NewPost;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts', 'HomeController@posts')->name('all.post');
Route::get('/post/{slug}', 'HomeController@post')->name('post.detail');
Route::get('/category-all', 'HomeController@categories')->name('categories');
Route::get('/category/{slug}', 'HomeController@categoryPost')->name('category.post');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/tag/{name}', 'HomeController@tagPosts')->name('tag.posts');

//comment
Route::post('/comment/{post_id}','CommentController@store')->name('usercomment.store');
Route::post('/comment-reply/{comment_id}','CommentReplyController@store')->name('comment.reply');

//admin routes+
Route::group(['prefix' => 'admin','middleware' => ['auth','admin'],'namespace' => 'Admin'],function(){
    Route::get('dashboard','AdminController@index')->name('admin.dashboard');
    Route::get('profile','AdminController@profile')->name('admin.profile');
    Route::put('profile-update','AdminController@profileUpdate')->name('admin.profile.update');
    Route::put('password-update','AdminController@passwordUpdate')->name('admin.password.update');
    Route::resource('user','UserController')->except(['create','show','edit','store']);
    Route::resource('category','CategoryController')->except(['create','show','edit']);
    Route::resource('post','PostController');
    // Route::resource('comment','CommentController');
    Route::get('comments','CommentController@index')->name('admin.comments.index');
    Route::delete('comment-delete/{id}','CommentController@destroy')->name('admin.comment.destroy');
    Route::get('reply-all','CommentController@replyAll')->name('admin.reply.all');
    Route::delete('reply-delete/{id}','CommentController@destroyReply')->name('admin.reply.destroy');
    Route::get('likedusers/{post_id}','CommentController@allLikedUsers')->name('liked.users.list');

});

//user routes
Route::group(['prefix' => 'user','middleware' => ['auth','user'], 'namespace' => 'User'],function(){
    Route::get('dashboard','UserController@index')->name('user.dashboard');
    Route::get('profile','UserController@profile')->name('user.profile');
    Route::put('profile-update','UserController@profileUpdate')->name('user.profile.update');
    Route::put('password-update','UserController@passwordUpdate')->name('user.password.update');
    Route::resource('comment','CommentController');
    Route::get('reply-all','CommentController@replyAll')->name('user.reply.all');
    Route::delete('reply-delete/{id}','CommentController@destroyReply')->name('user.reply.destroy');
    Route::post('post-like/{id}','likeController@like')->name('post.like');
    Route::get('my-likelist','likeController@likeList')->name('like.list');
});





//mail send test
// Route::get('/send',function(){
//     $post = \App\Post::findOrFail(3);
//     Mail::to('jjs@gmail.com')
//     ->bcc(['shan@gmail.com','shihab@gmail.com','kabir@gmail.com'])
//     ->queue(new NewPost($post));

//      return (new App\Mail\NewPost($post))->render();

// });

