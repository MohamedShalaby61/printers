<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\ServiceType;
use Illuminate\Http\Request;
use Validator;

class ServiceTypeController extends Controller
{
    
    public function index()
    {
        $serviceType = ServiceType::all();
        return response()->json(['serviceType' => $serviceType]);
    }

    public function show(ServiceType $serviceType)
    {
        return $serviceType ;
    }

    public function store(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'name' =>'required|string',
            'cost' =>'required|string'
           ]);

        if($validator->fails()){
             return response()->json(['error' => $validator->messages()->first()] , 401);
        }

        $service = ServiceType::create($request->all());

        return response()->json(['msg' => 'inserted successfully']);
     
    }

    public function update(Request $request, ServiceType $serviceType)
    {
         $validator = Validator::make($request->all(),[
         'name' =>'required',   
         'cost' =>'required'
         ]);
         if($validator->fails()){
             return response()->json(['error' => $validator->messages()->first()] , 401);
         }

       $serviceType->update($request->all());
       return response()->json(['msg' => 'updated successfully']);
    }

    
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return response()->json(['msg' => 'deleted Successfully']);
    }
}
