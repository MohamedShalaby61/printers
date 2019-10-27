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


use App\PrinterDetails;
use App\User;
use App\MyOrders;

Route::group(['middleware'=>'login_user'],function (){
    Route::prefix('users')->group(function() {
        Route::get('/superadmin', 'UserController@super_admin_index')->name('super_admin');
        Route::get('/owneradmin', 'UserController@owner_admin_index')->name('owner_admin');
        Route::get('/subowneradmin', 'UserController@sub_owner_admin_index')->name('sub_owner_admin');
        Route::get('/customer', 'UserController@customer')->name('customer');

        // edit users
        Route::get('/create','UserController@create')->name('users.create');
        Route::post('/create','UserController@store')->name('users.store');
        Route::get('/{id}/edit','UserController@edit')->name('users.edit');
        Route::put('/{id}/edit','UserController@update')->name('users.update');
        Route::delete('/{id}/delete','UserController@destroy')->name('users.destroy');

        Route::get('profile/{id}','UserController@profile')->name('profile');
        Route::put('profile_update/{id}','UserController@profile_update')->name('profile_update');
    });

    //index users
    Route::get('/home',function (){
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2){
            $printers = PrinterDetails::with(['user'])->get();
        }
        elseif(auth()->user()->role_id == 3){
            $printers = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->id)->get();
        }else{
            $printers = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->user_id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 ){
                $users = User::with(['user'])->where('role_id','=',5)->get();
                //dd($users);
            }else{
                $users = User::with(['user'])->where('role_id','=',5)->where('user_id' ,'!=',null)->where('user_id','=',auth()->user()->id)->get();
                //dd($users);
            }

            $ownerRows = User::where('role_id','=',3)->get();

           if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->get();
        }elseif(auth()->user()->role_id == 3){
            $printers = PrinterDetails::with(['user'])
            ->where('user_id','=',auth()->user()->id)
            ->get();
            $printerArray=[];
            $Counter = 0;
            foreach ($printers as $printer) {
                
                    $printerArray[$Counter] = $printer->id;
                    $Counter++;
                
            }
            //dd($printerArray);

            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->whereIn('printer_id', $printerArray)->get();
        }else{
            $printers = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->user_id)->get();

            $printerArray=[];
            $Counter = 0;
            foreach ($printers as $printer) {
                
                    $printerArray[$Counter] = $printer->id;
                    $Counter++;
                
            }
            //dd($printerArray);

            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->whereIn('printer_id', $printerArray)->get();
        }



        return view('common::index',compact('printers','users','ownerRows','rows'));
    })->name('home');
});

//login users
Route::get('/get/login','UserController@get_login')->name('get_login');
Route::post('/get/login','UserController@post_login')->name('post_login');
Route::get('get/logout','UserController@get_logout')->name('get_logout');
