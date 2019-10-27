<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Countries;

class CountriesController extends Controller
{
  public function list_countries(){
  	return response()->json(Countries::all());
  }
}
