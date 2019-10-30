<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\FontTypes;
use App\Countries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    	$userData = \Auth()->user();
    	$data = $request->validate([
    		'name'         => 'required',
    		'email'        => 'required',
    		'phone_number' => 'required',
    	]);



    	if ($request->has('password') && $request->password !== null) {
    		$data['password'] = bcrypt($request->password);
    	}


        if ($request->file){
            $file = $request->file('file');
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

    public function payment_form($id)
    {
        return view('login.payment_form',compact('id'));
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
        $array_php = json_decode($responseData, true);
        //dd($array_php);
        return response()->json(['id'=>$array_php['id']]);
        //return $responseData;
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
    
}
