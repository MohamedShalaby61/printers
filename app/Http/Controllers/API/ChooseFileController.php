<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use App\ChooseFile;
use Illuminate\Http\Request;

class ChooseFileController extends Controller
{
    
    
    public function store(Request $request)
    {
        
        

        if($request->hasFile('file')){
        	$allowedfileExtension=['pdf','jpg','png','docx'];
			$file = $request->file('file');
			// $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename =pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = md5($filename . time()) .'.' . $extension;
            
            $check=in_array($extension,$allowedfileExtension);

            if($check){
            	$request->validate([
		          'my_order_id' => 'required',
		          
		        ]);
		        $path     = $file->move(public_path("/storage") , $filename);
		        $fileURL  = url('/storage/'. $filename);
            	$order = ChooseFile::create([
                    'my_order_id' => $request->my_order_id,
                    'file' => $fileURL,
                ]);
		        return response()->json(['url' => $fileURL ,'success' => 'Uploaded Successfully !'],200);
            }


        }

    }


    
    
}
