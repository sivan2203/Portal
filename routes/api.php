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









