<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FontTypes;
use App\Countries;
use Session;

class UserController extends Controller
{
    public function index(){
    	$fonts = FontTypes::all();
    	return view('indexlogin',compact('fonts'));
    }

    public function editProfile(){
    	$fonts = FontTypes::all();
    	$countries = Countries::all();
       	$userData = \Auth()->user();
    	return view('editprofile',compact('fonts', 'userData' , 'countries'));
    }

    public function updateProfile(Request $request)
    {
    	$userData = \Auth()->user();
    	$data = $request->validate([
    		'name'         => 'required',
    		'email'        => 'required',
    		'phone_number' => 'required',
    	]);



    	if ($request->has('password') && $request->password !== null) {
    		$data['password'] = bcrypt($request->password);
    	}

    	$userData->update($data);

    	Session::flash('message', 'تم تحديث بياناتك بنجاح');
        Session::flash('alert-class', 'alert-success');
    	return redirect()->back();

    }

    
}
