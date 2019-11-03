<?php

namespace App\Http\Controllers;

use App\CompletedFile;
use App\Mail\PaymentMail;
use App\MyOrders;
use App\Notifications;
use App\payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\FontTypes;
use App\Countries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Modules\Offer\Entities\Offer;
use Session;
use AuthenticatesUsers;

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
        //dd($request->all());
    	$userData = \Auth()->user();
    	$data = $request->validate([
    		'name'         => 'required',
    		'email'        => 'required',
    		'phone_number' => 'required',
    	]);



    	if ($request->has('password') && $request->password !== null) {
    		$data['password'] = bcrypt($request->password);
    	}


        if ($request->file55){
            $file = $request->file('file55');
            $destinationPath = 'storage/users';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $data['avatar'] = url('/storage/users/'. $filename);
        }

    	$userData->update($data);

    	Session::flash('message', 'تم تحديث بياناتك بنجاح');
        Session::flash('alert-class', 'alert-success');
    	return redirect('/editProfile#goodProfile');

    }

    public function register_create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'area' => 'required',
        ]);

        $data['password'] = bcrypt($request->password);
        $user = User::create($data + ['role_id' => 4]);

        auth()->loginUsingId($user->id);

        return redirect()->route('index_login');
    }

    public function register_ajax(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'area' => 'required',
            'phone' => 'required',
        ]);

        if($data->fails()){
            return response()->json(['errors' => $data->errors()->getMessages()]);
        }else{
            $req_data = $request->all();
            $req_data['password'] = bcrypt($request->password);
            $user = User::create($req_data,['type' => 4]);
            \Auth::login($user);
            return response()->json(['errors' => null]);
        }
    }

    public function payment_form_view(Request $request,$id)
    {
        $order = MyOrders::find($id);
        $fonts = FontTypes::all();
        $notifications = Notifications::where('user_id',\auth()->user()->id)->get();
        return view('login.payment_form',compact('fonts','order','notifications'));
    }

    public function payment(Request $request){
        $payment_id = MyOrders::find($request->order_id)->order_cost->sortByDesc('id')->first()->id;
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4ca6da65700016db0c50a761d6c" .
            "&amount=". $request->amount .
            "&currency=". $request->currency .
            "&paymentType=DB" .
            "&notificationUrl=http://165.22.71.144/printers/public/paymentstatus" .
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
        $array_php = json_decode($responseData, true);
        //dd($array_php);
        return response()->json(['id'=>$array_php['id'],'payment_id' =>$payment_id]);
        //return $responseData;
    }

    public function paymentstatus($id){
        $url = "https://test.oppwa.com/v1/checkouts/".$id."/payment";
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
//        $array_php = json_decode($responseData, true);
//        return response()->json(['id'=>$array_php['id']]);
        return $responseData;
    }

    public function payment_form($id,$payment_id)
    {
        $payment_status = $this->paymentstatus($id);
            $array_php = json_decode($payment_status, true);
            $array_php['result']['code'];

            if ($array_php == "000.000.000" || $array_php == "000.000.100" || $array_php = "000.100.110" || $array_php = "000.100.111" || $array_php = "000.100.112"){
                $this->getPaidPayment($payment_id);

                Session::flash('message', 'تمت عملية الدفع بنجاح');
                Session::flash('alert-class', 'success');
                return redirect()->route('order_user');
            } else{
                Session::flash('message', 'خطأ في عملية الدفع');
                Session::flash('alert-class', 'danger');
                return redirect()->route('order_user');
            }
    }

    public function getPaidPayment($id){
        $payment = payment::find($id);
        $user = User::where('email',auth()->user()->email)->first();
        $useremail = $user->email;
        $paymentObj = Payment::where('id',$id)->first();
        $order_id = $paymentObj->order_id;
        $order = MyOrders::where('id','=',$order_id)->first();
        $completedFileID  = $order->completed_file_id;
        $fileObj = CompletedFile::where('id',$completedFileID)->first();
        $fileURL = $fileObj->url;

        $payment->update([
            'payment_status' => 1,
        ]);

        $order = MyOrders::find($payment->order_id);
        //dd($order);
        $order->update([
            'order_status_id' => 2,
        ]);

        $notification = Notifications::create([
            'title_ar' => 'اكتمل الطلب حمل الملف الان',
            'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
            'title_en' => 'success paid download file now',
            'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',

            'order_id'=> $order->id,
            'user_id' => $order->user_id
        ]);
        \App\Http\Controllers\API\NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);

        Mail::to($useremail)->send(new PaymentMail($fileURL));


        //return response()->json(['payment'=>$payment,'message'=>'تمت العملية بنجاح']);
    }

    public function checkCode(Request $request){
        if ($request->has('code')) {
            $offer = Offer::where('code',$request->code)->first();
            if ($offer !== null) {
                //dd(Carbon::now());
                if ($offer->ended_at >= Carbon::now()) {
//                    $payCost = (int)$payment->cost;
//                    $payDisCount = ($payCost * $offer->count) / 100;
//                    $payAfterDisCount = $payCost - $payDisCount;
//                    $payment->cost = $payAfterDisCount;
                    $payment = \App\payment::where('order_id',$request->order_id)->orderBy('id','desc')->first();
                    $payCost = (int)$payment->cost;
                    $payDisCount = ($payCost * $offer->count) / 100;
                    $payAfterDisCount = $payCost - $payDisCount;
                    $payment->cost = $payAfterDisCount;

                    return response()->json(['offer'=>$offer,'payment'=>$payAfterDisCount,'discount'=>$payDisCount,'message'=>'الكود صحيح']);
                }else{
                    return response()->json(['offer'=>null,'message'=>'انتهت صلاحية الكود']);
                }
            }else{
                return response()->json(['offer'=>null,'message'=>'الكود خاطيء ']);
            }

        }
    }
}
