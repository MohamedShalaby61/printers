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
use Illuminate\Http\Request;


Route::prefix('common')->group(function() {
    Route::get('/good', 'CommonController@index');
});

Route::get('/configs',function(){
	$row = DB::table('setting')->first();
	return view('common::configs',compact('row'));
})->name('configs');


Route::put('configs',function (Request $request){
	//dd($request->all());
		$row = DB::table('setting')->where('id',1);
		
		//dd($row);
	if ($request->is_available === 'on') {
		
		$row->update(['is_available' => 1]);
		
	}else{
		$row->update(['is_available' => 0]);
	}

	Session::flash('message', 'تمت العملية بنجاح');
    Session::flash('alert-class', 'alert-success');
       
        return redirect()->back();
	
})->name('update_configs');