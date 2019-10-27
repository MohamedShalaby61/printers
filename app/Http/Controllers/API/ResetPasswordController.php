<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Notifications\PasswordResetNotification;

class ResetPasswordController extends Controller
{
    

    use ResetsPasswords;

   
    protected function sendResetResponse(Request $request , $response){
    	$user = User::where('email',$request->email)->first();
    	if ($user !== null) {
    		$password = str_random(15);
    		$user->password = bcrypt($password);
    		$user->save();
    	return response(['message' => $response,'password'=>$password]);
    	}
    	return response(['message' => $response,'password'=>null]);
        
    }

    protected function sendResetFailedResponse(Request $request , $response){
        return response(['message' => $response] , 422);
    }

}
