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

Route::get('/','API\IndexController@menuIndex');
Route::get('/to-pho/{id}','API\IndexController@menuTopho');
Route::get('/detail/{id}','API\IndexController@menuIndex');
Route::get('/category/{id}','API\IndexController@menuIndex');



Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');
	Auth::routes();
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::get('/xxx','Admin\MenuController@getMenu');
	Route::resource('news', 'Admin\NewsController');
	Route::resource('users','Admin\UsersController');
	Route::resource('banners','Admin\BannerController');
	Route::resource('menus','Admin\MenuController');

    
});
//Route::get('/home', 'HomeController@index')->name('home');

