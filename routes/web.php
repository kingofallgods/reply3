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
Route::get('user', 'UserController@index');
Route::any('upload', ['uses'=>'UserController@upload']);
Route::group(['middleware' => ['web']], function () {

    Route::any('user/update/{id}', ['uses' => 'UserController@update'])->where ( [
        'id' => '\d+'
    ] );
});

Route::resource('article','ArticleController');
/*由于restful的article.destory路由无法使用，因此创建以下路由作为删除操作*/
Route::any('delete/{id}',['uses'=>'ArticleController@destroy','as'=>'article.delete']);

Route::any('commentindex',['uses'=>'CommentController@index','as'=>'comment.index']);
Route::any('commentdetail/{id}',['uses'=>'CommentController@detail','as'=>'comment.detail']);
Route::any('commentcreate',['uses'=>'CommentController@create','as'=>'comment.create']);