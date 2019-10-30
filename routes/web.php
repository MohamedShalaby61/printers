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
Route::get('/get/offers','MyOrdersController@offers')->name('offers_index');

Route::group(['middleware'=>'auth'],function (){
    Route::get('/index', 'UserController@index')->name('index_login');
    Route::get('/editProfile', 'UserController@editProfile')->name('editProfile');
	Route::put('/updateProfile', 'UserController@updateProfile')->name('updateProfile');
    Route::get('/myOrders', 'MyOrdersController@user_orders')->name('order_user');
    Route::get('/create_order', 'MyOrdersController@create_order')->name('order.create');
    Route::post('/store_order', 'MyOrdersController@store_order')->name('order.store');
    Route::post('register_create','UserController@register_create')->name('register_create');
    Route::post('delete_orders','MyOrdersController@delete_orders')->name('delete_orders');
    Route::post('edit_order_front','MyOrdersController@edit_order_front')->name('edit_order_front');
    Route::get('payment','UserController@payment');
    Route::get('paymentstatus','UserController@paymentstatus');
    Route::get('payment/form/{id}','UserController@payment_form')->name('payment_form');
    Route::post('choose_file', 'MyOrdersController@store');

});
    Route::get('redirec/back',function (){
        return redirect()->back();
    })->name('back_return');
Route::group(['middleware'=>'guest'],function (){
    Route::get('/','HomeController@index')->name('index_guest');
    Route::post('login_ajax','UserController@login_ajax')->name('login_ajax');
    Route::post('register_ajax','UserController@register_ajax')->name('register_ajax');
});