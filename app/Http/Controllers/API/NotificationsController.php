<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification;
use App\Notifications;
use App\User;
use App\MyOrders;
use Illuminate\Http\Request;


class NotificationsController extends Controller
{
    

    public function showUserNotifications(Notifications $notification , Request $request){
        $userid = $request->user_id;
        $notification = Notifications::where('user_id','=',$userid)->orderBy('id','desc')->get();

        return response()->json(['notification' => $notification]);

    }

    public function soso(){
        $array = ["duyv0ucVbG8:APA91bG0Ilu1dySW0RukFAb_FPNu020uVUL7JrnSppztGobh1KsX2ZLJogdj9QA9fKnegyiCpUnlo7VOpAQXlzHgEVpTyzEb0NI0gY4Rp6u_BBbtvzd3JkcqNAA929i-A8OL6hwkhmmi" , "fartDmGUzb4:APA91bGAtug3IM8w_zV2RTZluMSLTDyOY6Oo319Hr_2IYjCVg_k31UkEN9FQrcNi9aRW33HWe-ltUgMCCFwKSFzLlSLdxWWcUAnmOfsz0w-eHHrUPS8qMHxc8UIfXb1TJBRwSNmt656R"];
       return $this->sendFCM($array , 'Hello','test');

    }


    public static function sendFCM($arrIds=[],$mess,$title , $order_id) {
          
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = [
                    'registration_ids' => $arrIds,
                    'Content-available' => '1',
                    'notification' => [
                            "tag"=> $order_id,
                            "body"    => $mess,
                            "title"   => $title,
                    ]];

            $fields = json_encode ( $fields );
            
            
             
                                                                                                                                                                                                                  
    $ch = curl_init($url);                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($fields),
         "Authorization: key=AAAAdQkf4BA:APA91bEKoJU7Tm4Xmd1WDv25BrOjf0IpR8hvOBgL_T_pZG7WQerUpGFzatkj449IcsvE0DbabeQFDFjl62UtPxZqJYZZBIUBx_A7JpxLn52yOow5dZmUfttLcZFQydoLZzMQWNtIskUe")                                                                      
    );                                                                                                                   

    $result = curl_exec($ch);              
    return  $result;


    }

   
    
}
