<?php

namespace App\Http\Controllers;

use App\CompletedFile;
use App\payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MyOrders;
use App\FontTypes;
use App\User;
use Illuminate\Support\Facades\Auth;
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
       // start completed order variables

       $completedOrders_id = [2,4,6,7,8,9];
       $userid = auth()->user()->id;
       $completedOrders = MyOrders::whereIn('order_status_id', $completedOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
       $completedPayment = [];
       foreach ($completedOrders as $completedOrder) {
           $completedPayment[$completedOrder->id] = $completedOrder->id;
       }
       $CompletedFiles = [];
       foreach ($completedOrders as $completedOrder) {
           $CompletedFiles[$completedOrder->id] = $completedOrder->completed_file_id;
       }
       $payment = payment::whereIn('order_id',$completedPayment)->get();
       $files = CompletedFile::whereIn('id',$CompletedFiles)->get();
       $file = CompletedFile::all();
       $payment2 = payment::whereIn('order_id',$completedPayment)->get();
       foreach ($completedOrders as $completedOrder) {
           $completedOrder['payment'] = $payment2->whereIn('order_id',$completedOrder->id)->sortByDesc('id')->first();
       }
       foreach ($completedOrders as $completedOrder) {
           $completedOrder['file'] = $file->where('id',$completedOrder->completed_file_id)->sortByDesc('id')->first();
       }
       foreach ($completedOrders as $completedOrder) {
           if ($completedOrder->deliveryDate !== null) {
               $completedOrder['deliveryDate'] = Carbon::parse($completedOrder->deliveryDate)->format('d-m-Y');
           }
           if ($completedOrder->order_date !== null) {
               $completedOrder['order_date'] = Carbon::parse($completedOrder->order_date)->format('d-m-Y');
           }
       }

       // endcompleted order variables

       $onProgressOrders_id = [1,3];
       $userid = \auth()->user()->id;
       $onProgressOrders = MyOrders::whereIn('order_status_id' , $onProgressOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
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

       return view('myorders',compact('fonts','onProgressOrders','completedOrders'));
   }

   public function getCompletedOrders(Request $request){
        $completedOrders_id = [2,4,6,7,8,9];
        $userid = \Auth::user()->id;
        $completedOrders = MyOrders::whereIn('order_status_id', $completedOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
        
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
