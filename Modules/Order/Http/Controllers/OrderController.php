<?php

namespace Modules\Order\Http\Controllers;

use App\MyOrders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail; 
use App\Mail\PaymentMail;
use App\User;
use App\OrderStatus;
use App\OrderType;
use App\ServiceType;
use App\FontTypes;
use App\PrinterDetails;
use App\CompletedFile;
use App\payment;
use DB;
use App\Notifications;
use App\Http\Controllers\API;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->orderBy('id','DESC')->get();
        }elseif(auth()->user()->role_id == 3){
            $printers = PrinterDetails::with(['user'])
            ->where('user_id','=',auth()->user()->id)
            ->get();
            $printerArray=[];
            $Counter = 0;
            foreach ($printers as $printer) {
                
                    $printerArray[$Counter] = $printer->id;
                    $Counter++;
                
            }
            //dd($printerArray);

            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->whereIn('printer_id', $printerArray)->orderBy('id','DESC')->get();
        }else{
            $printers = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->user_id)->get();

            $printerArray=[];
            $Counter = 0;
            foreach ($printers as $printer) {
                
                    $printerArray[$Counter] = $printer->id;
                    $Counter++;
                
            }
            //dd($printerArray);

            $rows = MyOrders::with(['font_type','service_type','order_type','printer_details','order_status','user'])->whereIn('printer_id', $printerArray)->orderBy('id','DESC')->get();
        }
        
        //dd($rows);
        return view('order::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $row   = MyOrders::find($id);
        $users = User::where('role_id','=',4)->get();
        $orderStatus = OrderStatus::all();
        $orderType = OrderType::all();
        $serviceType = ServiceType::all();
        $fontType = FontTypes::all();
        $printers = PrinterDetails::all();
        return view('order::show',compact('row','users','orderStatus','orderType','serviceType','fontType','printers'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //$row   = MyOrders::find($id);
        $row   = MyOrders::with([
            'order_cost',
            'font_type',
            'service_type',
            'order_type',
            'printer_details',
            'order_status',
            'user',
            'order_cost'
        ])->find($id);

        $rowRelation = $row->order_cost->where('payment_status',0)->first();

        //dd($rowRelation);
        $users = User::where('role_id','=',4)->get();
        if ($row->order_status_id == 1) {
            $orderStatus = OrderStatus::query()->whereIn('id',[1,3])->get();
        }elseif ($row->order_status_id == 3) {
            $orderStatus = OrderStatus::query()->whereIn('id',[3,4])->get();
        }
        elseif ($row->order_status_id == 4) {
            $orderStatus = OrderStatus::query()->whereIn('id',[4])->get();
        }elseif($row->order_status_id == 6) {
            $orderStatus = OrderStatus::query()->whereIn('id',[6,7])->get();
        }elseif ($row->order_status_id == 2) {
            $orderStatus = OrderStatus::query()->whereIn('id',[2])->get();
        }elseif ($row->order_status_id == 8) {
            $orderStatus = OrderStatus::query()->whereIn('id',[8,4])->get();
        }elseif ($row->order_status_id == 7) {
            $orderStatus = OrderStatus::query()->whereIn('id',[7])->get();
        }else{
            $orderStatus = OrderStatus::all();
        }
        $orderType = OrderType::all();
        $serviceType = ServiceType::all();
        $fontType = FontTypes::all();
        $printers = PrinterDetails::all();
        return view('order::edit',compact('row','users','orderStatus','orderType','serviceType','fontType','printers','rowRelation'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $order = MyOrders::find($id);
        //dd($request->all());
        //dd($order);
        $data = $request->all();
        $user = User::find($order->user_id);
        $theFile = null;
        if ($request->has('completed_file') && $request->completed_file !== null) {
             $image = $request->file('completed_file');
             $name = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/storage/orders');
             $image->move($destinationPath, $name);
             

             $theFile = CompletedFile::create([
                'file' => $name,
                'url' => url('/storage/orders/'.$name),
             ]);

             
           // Mail::to($user->email)->send(new PaymentMail($theFile->url));
        }

        
        if ($theFile !== null) {
            $order->update($data+['completed_file_id'=>$theFile->id]);

        }else{
            $order->update($data);
        }
        //dd($request->all());
        if ($request->has('order_id') || $request->order_id !== null) {
            if ($order->update_count < 3 && $order->update_count >=1) {
                $payment = payment::find($request->order_id)->update([
                'cost' => $request->cost,
                'order_id' => $order->id,
                'payment_status'=> 1,
                    ]);
            }else{
                $payment = payment::find($request->order_id)->update([
                'cost' => $request->cost,
                'order_id' => $order->id,
                'payment_status'=> 0,
                    ]);     
            }
            
        }else{
            if ($order->update_count < 3 && $order->update_count >=1) {
                $payment = payment::create([
                    'cost' => $request->cost,
                    'order_id' => $order->id,
                    'payment_status'=> 1,
                        ]);
            }else{
                $payment = payment::create([
                    'cost' => $request->cost,
                    'order_id' => $order->id,
                    'payment_status'=> 0,
                        ]);
            }
        }
        //dd($payment);
        
        Session::flash('message', 'تم تعديل الطلب بنجاح');
        Session::flash('alert-class', 'alert-success');
            
        if ($order->order_status_id == 3) {
            $notification = Notifications::create([
                'title_ar' => 'طلبك قيد التنفيذ',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'your order in progress',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
            $notification_data = $notification->data;
            \App\Http\Controllers\API\NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);
        }elseif ($order->order_status_id == 4) {
            $notification = Notifications::create([
                'title_ar' => 'انتهي العمل وفي انتظار الدفع',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'your order is complete and waiting for paid',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
            \App\Http\Controllers\API\NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);
        }elseif($order->order_status_id == 7){
            $notification = Notifications::create([
                'title_ar' => 'انتهي طلب التعديل',
                'data_ar' => $order->id . ' - ' . $order->service_type->id == 1 ? 'كتابة فقط' : 'تنسيق وكتابة ابحاث',
                'title_en' => 'editing is completed',
                'data_en' => $order->id . ' - ' . $order->service_type->id == 1 ? 'writing only' : 'write and make research',
                'order_id'=> $order->id,
                'user_id' => $order->user_id
            ]);
            \App\Http\Controllers\API\NotificationsController::sendFCM([$user->device_token],$notification->data_ar,$notification->title_ar , $order->id);
            if($theFile !== null){
                Mail::to($user->email)->send(new PaymentMail($theFile->url));
            }
            
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $order = MyOrders::find($id);
        $order->delete();

        Session::flash('message', 'تم حذف الطلب بنجاح');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
