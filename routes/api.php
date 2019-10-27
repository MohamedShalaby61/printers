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


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('edit_account', 'API\UserController@editAccount');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});

Route::post('password/email','API\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset','API\ResetPasswordController@reset');
Route::post('password/forget','API\UserController@forget_password');

//order routes
Route::get('all_orders', 'API\MyOrdersController@index');
Route::get('orders', 'API\MyOrdersController@show');
Route::post('get/order','API\MyOrdersController@getOrder');
Route::get('order/user/{user}', 'API\MyOrdersController@showUserOrders');
Route::post('insert_order', 'API\MyOrdersController@store');
Route::put('update_order/{order}', 'API\MyOrdersController@update');
Route::put('rate_order', 'API\MyOrdersController@rate_order');
Route::post('modify_order', 'API\MyOrdersController@modifyOrder');
Route::delete('delete_order', 'API\MyOrdersController@destroy');
Route::get('getCompletedOrders','API\MyOrdersController@getCompletedOrders');
Route::get('getOnProgressOrders','API\MyOrdersController@getOnProgressOrders');
Route::post('paymentForCustomer','API\MyOrdersController@paymentForCustomer');
Route::post('getPaidPayment','API\UserController@getPaidPayment');
Route::get('payment','API\UserController@payment');
Route::get('paymentstatus','API\UserController@paymentstatus');
Route::post('getCompletedFiles','API\MyOrdersController@getCompletedFiles');
Route::post('checkCode','API\UserController@checkCode');

//font type routes
Route::get('font_types', 'API\FontTypesController@index');
Route::get('font_type/{fontType}', 'API\FontTypesController@show');
Route::post('insert_font', 'API\FontTypesController@store');
Route::put('update_font/{fontType}', 'API\FontTypesController@update');
Route::delete('delete_font/{fontType}', 'API\FontTypesController@destroy');

//get notification with user id
Route::get('notification', 'API\NotificationsController@showUserNotifications');
Route::post('sendfcm', 'API\NotificationsController@sendFCM');
Route::post('soso', 'API\NotificationsController@soso');
Route::get('offers','API\MyOrdersController@getOffers');

//service type routes
Route::get('all_service_types', 'API\ServiceTypeController@index');
Route::get('service_type/{serviceType}', 'API\ServiceTypeController@show');
Route::post('insert_service_type', 'API\ServiceTypeController@store');
Route::put('update_service_type/{serviceType}', 'API\ServiceTypeController@update');
Route::delete('delete_service_type/{serviceType}', 'API\ServiceTypeController@destroy');

//choose File Routes
Route::post('choose_file', 'API\ChooseFileController@store');
Route::post('upload_modified', 'API\UploadModifiedFilesController@store');
Route::post('completed_file', 'API\CompletedFileController@store');


//list countries
Route::get('list_countries', 'API\CountriesController@list_countries');


// rate groups
Route::post('createRateQuestions','API\MyOrdersController@createRateQuestions');

Route::get('notify', function(){
});

