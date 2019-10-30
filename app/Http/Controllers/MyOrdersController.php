<?php

namespace App\Http\Controllers;

use App\ChooseFile;
use App\CompletedFile;
use App\Notifications;
use App\payment;
use App\PrinterDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MyOrders;
use App\FontTypes;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Offer\Entities\Offer;
use Validator;

class MyOrdersController extends Controller
{

    public function store(Request $request)
    {
        //dd($request->all());
        if($request->file){
        foreach ($request->file as $file){
            $allowedfileExtension=['pdf','jpg','png','docx'];
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename =pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = md5($filename . time()) .'.' . $extension;

            $check=in_array($extension,$allowedfileExtension);

            if($check){
                $path     = $file->move(public_path("/storage") , $filename);
                $fileURL  = url('/storage/'. $filename);
                $order = \App\MyOrders::where('user_id',auth()->user()->id)->orderBy('id','desc')->first();
                $order_id = $order->id;
                $order = ChooseFile::create([
                    'my_order_id' => $order_id,
                    'file' => $fileURL,
                ]);

            }
        }
            $order = \App\MyOrders::where('user_id',auth()->user()->id)->orderBy('id','desc')->first();
            $files = ChooseFile::where('my_order_id',$order->id);
        if ($files === null){
            $order->delete();
        }
            return redirect()->back();


        }

    }

   public function store_order(Request $request){
   	
   	$data = Validator::make($request->all(),[
         'service_type_id' => 'integer|required', 
         'order_type_id'   => 'integer|required', 
         'font_type_id'    => 'integer|required',
         'font_size'       => 'integer|required'
   	]);

      if($data->fails()){
          return response()->json(['errors' => $data->errors()->getMessages(),'id'=>null]);
      }else{

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

          $order = MyOrders::create($request->all()+['printer_id'=> $selectedPrinterId,'user_id'=> auth()->user()->id ]);


          $payment = payment::create([
              'order_id'=>$order->id
          ]);

          if($request->hasFile('file')){
              $allowedfileExtension=['pdf','jpg','png','docx'];
              $file = $request->file('file');
              // $filename = $file->getClientOriginalName();
              $extension = $file->getClientOriginalExtension();
              $filename =pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
              $filename = md5($filename . time()) .'.' . $extension;

              $check=in_array($extension,$allowedfileExtension);

              $fileURL = '';
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


          return response()->json(['errors' => null,'id'=>$order->id]);
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

    public function offers()
    {
        $fonts = FontTypes::all();
        $offers = Offer::all();

        return view('offers',compact('fonts','offers'));
    }

    public function delete_orders(Request $request)
    {
        $order = MyOrders::find($request->id);
        $order->delete();
        return response()->json();
    }

    public function edit_order_front(Request $request)
    {
        $orderid = $request->id;
        $updatenotes = $request->update_notes;

        $order = MyOrders::find($orderid);


        $orderCount = $order->order_count + 1;




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

}
