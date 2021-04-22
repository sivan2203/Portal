<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//news
Route::get('news/all', 'News\NewsController@news');
Route::get('news/{id}', 'News\NewsController@newsById');
Route::post('news/new', 'News\NewsController@newsSave');
Route::put('news/edit/{id}', 'News\NewsController@newsEdit');
Route::delete('news/delete/{id}', 'News\NewsController@newsDelete');
//peoples
Route::get('peoples/all', 'People\PeopleController@peoples');
Route::get('peoples/{id}', 'People\PeopleController@peoplesById');
Route::post('peoples/new', 'People\PeopleController@peoplesSave');
Route::put('peoples/edit/{id}', 'People\PeopleController@peoplesEdit');
Route::delete('peoples/delete/{id}', 'People\PeopleController@peoplesDelete');
//comments
Route::get('comments/all', 'Comments\CommentsController@comments');
Route::get('comments/{id}', 'Comments\CommentsController@commentsById');
Route::post('comments/new', 'Comments\CommentsController@commentsSave');
Route::put('comments/edit/{id}', 'Comments\CommentsController@commentsEdit');
Route::delete('comments/delete/{id}', 'Comments\CommentsController@commentsDelete');
//images
Route::get('images/all', 'Images\ImagesController@images');
Route::get('images/{id}', 'Images\ImagesController@imagesById');
Route::post('images/new', 'Images\ImagesController@imagesSave');
Route::put('images/edit/{id}', 'Images\ImagesController@imagesEdit');
Route::delete('images/delete/{id}', 'Images\ImagesController@imagesDelete');











