<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use App\MyOrders;
use App\OrderStatus;
use App\User;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\PrinterDetails;
use App\payment;
use App\Notifications;
use App\CompletedFile;
use Modules\Offer\Entities\Offer;
use Carbon\Carbon;
use App\Question;
use App\Http\Controllers\API;

class MyOrdersController extends Controller
{
    
    // public function index()
    // {
    //     // $orders = MyOrders::all();
    //     $orders = MyOrders::with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->get();


    //     return response()->json(['data' => $orders]);
    // }

    
    
    
    public function store(Request $request)
    {   
          $setting = DB::table('setting')->first();
          $is_available= $setting->is_available;
          $user = User::find(53);
           
         if ($is_available == 1)
         {
           
          $adminPrinters = $user->getPrinter->where('isActive',1);
          //dd($adminPrinters);
          $sortedPrinter = $adminPrinters->sortBy(function($count){
             return $count->orderCount;
          });
            //dd($sortedPrinter);
            $selectedPrinterId = $sortedPrinter->first()->id;
            //dd($selectedPrinterId);
            $counter =  $sortedPrinter->first()->orderCount;
            $final = $sortedPrinter->first();
            $final->orderCount = $counter+1;
            $final->save();

           
         }
         else
         {
            $otherPrinters = PrinterDetails::where('isActive',1)->where('user_id','!=',$user->id)->get(); 
         
           $sortedPrinter = $otherPrinters->sortBy(function($count){
             return $count->orderCount;
          });
           $selectedPrinterId = $sortedPrinter->first()->id;
           //dd($selectedPrinterId);
           $counter =  $sortedPrinter->first()->orderCount;
            $final = $sortedPrinter->first();
            $final->orderCount = $counter+1;
            $final->save();


         }


        $request->validate([
          'user_id' => 'required',
        ]);

        $order = MyOrders::create($request->all()+['printer_id'=> $selectedPrinterId]);
        $payment = payment::create([
          'order_id'=>$order->id
        ]);
       

         $notification = Notifications::create([
          'title_ar' => 'تم الاستقبال من قبل المطبعة',
          'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
          'title_en' => 'your order recieved successfully',
          'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
          'user_id'  =>$order->user_id,
          'order_id' => $order->id
   
        ]);




        $good = NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);
        
        //dd($user->name);

       return response()->json(['msg' => 'stored successfully' , 'order' => $order,'payment'=>$payment]);

     // return response()->json(['msg' => 'stored successfully' , 'order' => $SelectedPrinterId]);
  
    }



    
    public function show(MyOrders $order , Request $request)
    {   
        $orderid = $request->order_id;
        $order   = MyOrders::with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->where('id' ,'=',$orderid)->first();
        return response()->json(['order' => $order]);
        
    }

     public function getOffers(){
        $offers = Offer::all();

        foreach ($offers as $offer) {
          $offer['started_at'] = Carbon::parse($offer->started_at)->format('d-m-Y');
          $offer['ended_at'] = Carbon::parse($offer->ended_at)->format('d-m-Y');
        }
        return response()->json(['offers' => $offers]);
      }



public function getOrder(Request $request)
    {
        $orderid = $request->order_id;
        $order = MyOrders::with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->find($orderid);

        $completedOrder = CompletedFile::find($order->completed_file_id);
        $paymentStatus = payment::where('order_id','=',$order->id)->orderBy('id','desc')->first();
        //dd($paymentStatus);
        $payment = Payment::where('order_id',$orderid)->orderBy('id','desc')->first();

        $order['payment'] = $payment;


        $order['file'] = $completedOrder;
         $order['payment_status'] = $paymentStatus->payment_status;


        return response()->json(['order'=>$order]);
    }

    // public function showUserOrders(MyOrders $order , Request $request){
    //     $userid = $request->user_id;
    //     $statusid = $request->status_id;
    //     $order = MyOrders::with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->where('user_id' ,'=',$userid)->where('order_status_id','=' , $statusid)->where('deleted_at','=',null)->get();
    //     return response()->json(['user_orders' => $order]);
    // }

    public function rate_order(Request $request){
        $order_id = $request->order_id;
        $rating_number = $request->rating_number;
        
        
        $order = MyOrders::find($request->order_id);
        // dd($order);
        $order->update(['rate'=> $rating_number]);
        return response()->json(['rate' => 'Rated Successfully']);
    }

   
    public function update(Request $request, MyOrders $order)
    {
        $validator = Validator::make($request->all(),[
         'pages_number' =>'integer'   
         
         ]);
         if($validator->fails()){
             return response()->json(['error' => $validator->messages()->first()] , 401);
         }

       $order->update($request->all());
       return response()->json(['msg' => 'updated successfully']);



    }

    public function modifyOrder(Request $request){

         $orderid = $request->order_id; 
         $updatenotes = $request->update_notes; 

         $order = MyOrders::find($orderid); 
         
       
        $orderCount = $request->order_count; 

        


        if($orderCount >= 3){
           $order->update(['order_status_id' => '8' , 'update_count' =>$orderCount ,'update_notes'=> $updatenotes]);
if ($order->order_status_id == 2) {
            Notifications::create([
                'title_ar' => 'اكتمل الطلب حمل الملف الان',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'complete you can Download the file now',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }elseif ($order->order_status_id == 6) {
            Notifications::create([
                'title_ar' => 'الطلب تحت التعديل',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'The application is under editing',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }elseif($order->order_status_id == 8){
            Notifications::create([
                'title_ar' => 'الطلب تحت التعديل',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'The application is under editing',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }

           return response()->json(['message' => 'you will get notified soon']);
        }else{
           $order->update(['order_status_id' =>'6' , 'update_count' =>$orderCount , 'modified_cost' =>'0' ,'update_notes'=> $updatenotes ]);
if ($order->order_status_id == 2) {
            Notifications::create([
                'title_ar' => 'اكتمل الطلب حمل الملف الان',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'complete you can Download the file now',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }elseif ($order->order_status_id == 6) {
            Notifications::create([
                'title_ar' => 'الطلب تحت التعديل',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'The application is under editing',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }elseif($order->order_status_id == 8){
            Notifications::create([
                'title_ar' => 'الطلب تحت التعديل',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'The application is under editing',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
        }

           return response()->json(['message' => 'you will get notified soon']);

        }
    }

    


    public function getCompletedOrders(Request $request){
        $completedOrders_id = [2,4,6,7,8,9];
        $userid = $request->user_id;
        $completedOrders = MyOrders::whereIn('order_status_id', $completedOrders_id )->where('user_id', '=' , $userid)->with('font_type')->with('service_type')->with('order_type')->with('printer_details')->with('order_status')->orderBy('id','desc')->get();
        //dd($completedOrders);
        $completedPayment = [];
        foreach ($completedOrders as $completedOrder) {
          $completedPayment[$completedOrder->id] = $completedOrder->id;
        }

        
        $CompletedFiles = [];
        foreach ($completedOrders as $completedOrder) {
            $CompletedFiles[$completedOrder->id] = $completedOrder->completed_file_id;
        }

        //dd($CompletedFiles);
        $payment = payment::whereIn('order_id',$completedPayment)->get();
        
        //dd($payment2);
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

        return response()->json(['completed' =>$completedOrders]);
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

public function getCompletedFiles(Request $request){
        $orderid = $request->order_id;
        $order = MyOrders::find($orderid);
        $files = CompletedFile::where('id',$order->completed_file_id)->first();
        return response()->json(['file'=>$files]);
    }


    public function paymentForCustomer(Request $request){
      $request->user_id;
      
      $order = MyOrders::find($request->order_id);
      $payment = $order->order_cost->where('payment_status',0)->first();
      $payment->payment_status = 1;
      $payment->save();
      
      $order->order_status_id = 2;
      $order->save();

      
            
      

      return response()->json(['payment'=>$payment]);
    }

    
    public function destroy(MyOrders $order , Request $request){
       $orderid = $request->order_id;
       $order->where('id' , '=' , $orderid)->delete();
       return response()->json(['msg'=>'deleted successfully']);
    }


    public function createRateQuestions(Request $request){

      $question = Question::where('user_id',$request->user_id)->orderBy('id','desc')->first();
      //dd($question);
      if ($question !== null) {
          $questions = Question::find($question->id);
          $questions->update($request->all());

      //dd($questions);
      }else{
          $questions = Question::create($request->all());
          $questions = Question::find($questions->id);
      }

      //$questionss = Question::where('user_id',$questions->user_id)->first();
      return response()->json(['questions' => $questions,'message'=> 'شكرا لك تم استقبال التقييم']);
    }

}
