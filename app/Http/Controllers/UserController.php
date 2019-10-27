<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FontTypes;

class UserController extends Controller
{
    public function index(){
    	$fonts = FontTypes::all();
    	return view('indexlogin',compact('fonts'));
    }

    public function editProfile(){
    	$fonts = FontTypes::all();
    	return view('editprofile',compact('fonts'));
    }

    
}
