<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyOrders;
use App\FontTypes;
use App\User;
use Validator;

class MyOrdersController extends Controller
{
 
   public function store_order(Request $request){
   	
   	$data = Validator::make($request->all(),[
         'file'            => 'required', 
         'service_type_id' => 'integer|required', 
         'order_type_id'   => 'integer|required', 
         'font_type_id'    => 'integer|required',
         'font_size'       => 'integer|required'
   	]);

      if($data->fails()){
          return response()->json(['errors' => $data->errors()->getMessages()]);
      }else{

         //$data = (array) $data;
         //$array = json_decode(json_encode($data), true);
         
         //dd($data);
          MyOrders::create($request->all() + ['user_id' => auth()->user()->id ]);
          return response()->json(['errors' => null]);
      }



   }

   public function user_orders(){
       $fonts = FontTypes::all();
       return view('myorders',compact('fonts'));
   }



   public function getCompletedOrders(Request $request){
        $completedOrders_id = [2,4,6,7,8,9];
        $userid = \Auth::user()->id;
        $completedOrders = MyOrders::whereIn('order_status_id', $completedOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
        
        $orderType = $completedOrders->orderType->type;
        $orderType = $completedOrders->orderType->type;
    }


    public function getOnProgressOrders(Request $request){
        $onProgressOrders_id = [1,3];
        $userid = $request->user_id;
        $onProgressOrders = MyOrders::whereIn('order_status_id' , $onProgressOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
        
        
        
        //$payment2 = payment::whereIn('order_id',$CompletedFiles)->get();
        // dd($onProgressOrders);

            foreach ($onProgressOrders as $onProgressOrder) {
                  if ($onProgressOrder->deliveryDate !== null) {
                    $onProgressOrder['deliveryDate'] = Carbon::parse($onProgressOrder->deliveryDate)->format('m-d-Y');
                  }

                  if ($onProgressOrder->order_date !== null) {
                    $onProgressOrder['order_date'] = Carbon::parse($onProgressOrder->order_date)->format('m-d-Y');
                  }

            }


            $progressPayment = [];
            foreach ($onProgressOrders as $onProgressOrder) {
              $progressPayment[$onProgressOrder->id] = $onProgressOrder->id;
            }

            $payment2 = payment::whereIn('order_id',$progressPayment)->get();
            foreach ($onProgressOrders as $onProgressOrder) {
                $onProgressOrder['payment'] = $payment2->whereIn('order_id',$onProgressOrder->id)->sortByDesc('id')->first();
            }
          

        return response()->json(['On_Progress' =>$onProgressOrders]);
    }









}
