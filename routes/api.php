<?php

use Illuminate\Http\Request;

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
Route::group(['prefix' => '/', 'namespace' => 'API', 'as' => 'api.'], function () {
    //Route::resource('index', 'IndexController', ['except' => ['index']]);
	Route::get('book/{limit}','IndexController@getnewsI');
	Route::get('book/cat/{id}','IndexController@getBookByCat');
	Route::get('cat/{id}','IndexController@getCategory');
	Route::get('cat/{id}/{limit}','IndexController@getBookIndex');
	Route::get('bookdetail/cat/{id}','IndexController@getCategorybyCode');
	Route::get('bookdetail/{id}','IndexController@getBookDetail');
	Route::get('index/{id}','IndexController@show')->where(['id' => '[0-9]+']);
	Route::get('index/banner/','IndexController@Bannerlist');
});
