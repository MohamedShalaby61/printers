<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Notifications\PasswordResetNotification;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    
    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request , $response){
        return response(['message' => $response]);
    }

    protected function sendResetLinkFailedResponse(Request $request , $response){
        return response(['message' => $response] , 422);
    }
}
