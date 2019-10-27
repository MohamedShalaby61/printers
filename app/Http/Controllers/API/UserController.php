<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\CompletedFile;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail; 
use Validator;
use App\payment;
use App\MyOrders;
use Modules\Offer\Entities\Offer;
use Carbon\Carbon;
use App\Notifications;
use App\Mail\PaymentMail;
use App\Mail\ResetPasswordNative;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            
                if (request('device_token') != $user->device_token) {
                    $user->device_token = request('device_token');
                    $user->save();
                }
            
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['id'] =  $user->id; 
            $success['name'] =  $user->name; 
            $success['email'] =  $user->email; 
            $success['device_token'] =  $user->device_token;
            $success['avatar'] = $user->avatar;
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            $success['token'] = '';
            $success['id'] = '';
            $success['name'] = '';
            $success['email'] = '';
            $success['device_token'] = '';
            $success['avatar'] = '';
            return response()->json(['success'=>$success], 200); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|unique:users', 
            'password' => 'required', 
            'c_password' => 'required|same:password',
            'area' => 'max:255', 
            'phone_number' => 'max:15|unique:users', 
            'image'  => 'image',
        ]);

        
        if ($validator->fails()) {
            
            
            return response()->json(['data'=>null,'message'=>$validator->messages()->first()], 200);            
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        if($request->hasFile('image')){
            $input['image'] = $request->file('image');
            $allowedfileExtension=['jpg','png'];
            $extension = $input['image']->getClientOriginalExtension();
            $filename =pathinfo($input['image']->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = md5($filename . time()) .'.' . $extension;            
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $path     = $input['image']->move(public_path("/storage") , $filename);
                $fileURL  = url('/storage/'. $filename);
                $user = User::create($input);
            }

        }

        $user = User::create($input+['role_id' => 4]);
              
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name']  =  $user->name;
        $success['id']    =  $user->id;
        $success['email'] =  $user->email;
        if(isset($input['image'])){
            $success['image'] =  $fileURL;
        }
        if(isset($input['phone_number'])){
            $success['phone_number'] =  $user->phone_number;
        }
        if(isset($input['area'])){
            $success['area'] =  $user->area;
        }

        if(isset($input['device_token'])){
            $success['device_token'] =  $user->device_token;
        }

        return response()->json([ 'data'=>$success,'message' =>'' ], $this-> successStatus); 
    }

    

    public function getPaidPayment(Request $request){
        $payment = payment::find($request->id);
        $user = User::where('email',$request->user_email)->first();
        $useremail = $user->email;
        $paymentObj = Payment::where('id',$request->id)->first();
        $order_id = $paymentObj->order_id;
        $order = MyOrders::where('id','=',$order_id)->first();
        $completedFileID  = $order->completed_file_id;
        $fileObj = CompletedFile::where('id',$completedFileID)->first();
        $fileURL = $fileObj->url;
        
        //dd($payment);
        if ($request->has('code')) {
                $offer = Offer::where('code',$request->code)->first();
            if ($offer !== null) {
                //dd(Carbon::now());
                if ($offer->ended_at >= Carbon::now()) {
                    
                    //$newPayment = ($offer->count / 100) * $payment->cost;
                    $payCost = (int)$payment->cost;
                    $payDisCount = ($payCost * $offer->count) / 100;
                    $payAfterDisCount = $payCost - $payDisCount;
                    $payment->cost = $payAfterDisCount;
                    $payment->payment_status = 1;
                    $payment->save();
                   return response()->json(['payment'=>$payment,'message'=>'تم الدفع بنجاح , من فضلك إفحص إيميلك']); 
                }else{
                    return response()->json(['payment'=>null,'message'=>'الكود خاطيء او انتهت صلاحيته']); 
                }
            }else{
                    return response()->json(['payment'=>null,'message'=>'الكود خاطيء او انتهت صلاحيته']);
            }

        }

        $payment->update([
            'payment_status' => 1,
        ]);
        
        $order = MyOrders::find($payment->order_id);
        //dd($order);
        $order->update([
            'order_status_id' => 2,
        ]);

        $notification =Notifications::create([
                        'title_ar' => 'اكتمل الطلب حمل الملف الان',
                        'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                        'title_en' => 'success paid download file now',
                        'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                        
                        'order_id'=> $order->id,
                        'user_id' => $order->user_id
            ]); 
        \App\Http\Controllers\API\NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);   

            Mail::to($useremail)->send(new PaymentMail($fileURL));

            if (Mail::failures()) {
               return response()->json(['message'=>'من قضلك أعد المحاوله لاحقا']);
             }else{
               return response()->json(['message'=>'من فضلك أفحص الإيميل']);
             }

        return response()->json(['payment'=>$payment,'message'=>'تمت العملية بنجاح']);
    }


    public function checkCode(Request $request){
        if ($request->has('code')) {
                $offer = Offer::where('code',$request->code)->first();
            if ($offer !== null) {
                //dd(Carbon::now());
                if ($offer->ended_at >= Carbon::now()) {
                    
                    //$newPayment = ($offer->count / 100) * $payment->cost;
                    //$payCost = (int)$payment->cost;
                    //$payDisCount = ($payCost * $offer->count) / 100;
                    //$payAfterDisCount = $payCost - $payDisCount;
                    //$payment->cost = $payAfterDisCount;
                    //$payment->save();
                    //return $payment;

                    return response()->json(['offer'=>$offer,'message'=>'الكود صحيح']);
                }else{
                    return response()->json(['offer'=>null,'message'=>'انتهت صلاحية الكود']); 
                }
            }else{
                    return response()->json(['offer'=>null,'message'=>'الكود خاطيء ']);
            }

        }
    }



    public function editAccount(Request $request , User $user){

           $validator = Validator::make($request->all(), [
                'email' => 'unique:users,email,'.$request->user_id, 
                'image'  => 'image',
                'user_id'=> 'required|integer',
            ]);

            
            if ($validator->fails()) {
                return response()->json(['message'=>$validator->messages()->first(),'id' => 0], 200);            
            }
            
            
            $requests = $request->all();
            
            if($request->has('password')){
                $requests['password'] = bcrypt($request->password);
            }

            $fileURL = '';
                  
               
                if ($request->image){
                    $file = $request->file('image');
                    $destinationPath = 'storage/users';
                    $originalFile = $file->getClientOriginalName();
                    $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
                    $file->move($destinationPath, $filename);
                    $requests['avatar'] = url('/storage/users/'. $filename);
                }
                
            $user = User::find($request->user_id);
            $update = User::find($request->user_id)->update($requests);

            return response()->json([ 'id'=>1 , 'message' =>'user updated successfully','url' => $user->image], $this-> successStatus);

    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 


    public function payment(Request $request){
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4ca6da65700016db0c50a761d6c" .
                    "&amount=". $request->amount .
                    "&currency=". $request->currency .
                    "&paymentType=DB" .
                    "&notificationUrl=http://165.22.71.144/printers/public/api/paymentstatus" . 
                    "&testMode=EXTERNAL" . 
                    "&merchantTransactionId=" . $request->user_id .
                    "&customer.email=" . $request->user_email;
                    

         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGFjN2E0Y2E2ZGE2NTcwMDAxNmRiMGM0MWU1OTFkNjh8ODNFQmRTWk4zSA=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function paymentstatus(Request $request){
        $url = "https://oppwa.com/v1/checkouts/".$request->checkoutID."/payment";
        $url .= "?entityId=8ac7a4ca6da65700016db0c50a761d6c";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGFjN2E0Y2E2ZGE2NTcwMDAxNmRiMGM0MWU1OTFkNjh8ODNFQmRTWk4zSA=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function forget_password(Request $request){

                $user = User::where('email',$request->email)->first();
                //dd($user);
                $password = $this->generateRandomString();
                $user->password = bcrypt($password);
                Mail::to($request->email)->send(new ResetPasswordNative($password));
                $user->save();
        return response()->json(['message'=>'check your password']);
    }

    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
}
