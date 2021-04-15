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
Route::get('news', 'News\NewsController@news');
Route::get('news/{id}', 'News\NewsController@newsById');
Route::post('news', 'News\NewsController@newsSave');
Route::put('news/{id}', 'News\NewsController@newsEdit');
Route::delete('news/{id}', 'News\NewsController@newsDelete');
//peoples
Route::get('peoples', 'People\PeopleController@peoples');
Route::get('peoples/{id}', 'People\PeopleController@peoplesById');
Route::post('peoples', 'People\PeopleController@peoplesSave');
Route::put('peoples/{id}', 'People\PeopleController@peoplesEdit');
Route::delete('peoples/{id}', 'People\PeopleController@peoplesDelete');
//comments
Route::get('comments', 'Comments\CommentsController@comments');
Route::get('comments/{id}', 'Comments\CommentsController@commentsById');
Route::post('comments', 'Comments\CommentsController@commentsSave');
Route::put('comments/{id}', 'Comments\CommentsController@commentsEdit');
Route::delete('comments/{id}', 'Comments\CommentsController@commentsDelete');
//images
Route::get('images', 'Images\ImagesController@images');
Route::get('images/{id}', 'Images\ImagesController@imagesById');
Route::post('images', 'Images\ImagesController@imagesSave');
Route::put('images/{id}', 'Images\ImagesController@imagesEdit');
Route::delete('images/{id}', 'Images\ImagesController@imagesDelete');











