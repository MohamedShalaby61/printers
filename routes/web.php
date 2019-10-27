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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('/');
});
Route::get('/','HomeController@index')->name('index_guest');
Route::get('/index', 'UserController@index')->name('index_login');
Route::get('/editProfile', 'UserController@editProfile')->name('editProfile');
Route::put('/updateProfile', 'UserController@updateProfile')->name('updateProfile');
Route::get('/offers', 'OffersController@index');
Route::get('/myOrders', 'MyOrdersController@user_orders');
Route::get('/create_order', 'MyOrdersController@create_order')->name('order.create');
Route::post('/store_order', 'MyOrdersController@store_order')->name('order.store');


