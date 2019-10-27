<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use App\FontTypes;
use Illuminate\Http\Request;
use Validator;

class FontTypesController extends Controller
{
    public function index()
    {      
        $fonts = FontTypes::all();
        return response()->json(['fonts' => $fonts]);
    }


    
    public function show(FontTypes $fontType)
    {
        return $fontType ;
    }

    public function store(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'line_type' =>'required'
           ]);

        if($validator->fails()){
             return response()->json(['error' => $validator->messages()->first()] , 401);
        }

        $line_type = FontTypes::create($request->all());

        return response()->json(['msg' => 'inserted successfully']);
     
    }


    public function update(Request $request, FontTypes $fontType)
    {
         $validator = Validator::make($request->all(),[
         'line_type' =>'required|string'   
         
         ]);
         if($validator->fails()){
             // dd($request->all());
             return response()->json(['error' => $validator->messages()->first()] , 401);
         }

       $fontType->update($request->all());
       return response()->json(['msg' => 'updated successfully']);
    }

    
    public function destroy(FontTypes $fontType)
    {
        $fontType->delete();
        return response()->json(['msg' => 'deleted Successfully']);
    }

    
     
    
}
