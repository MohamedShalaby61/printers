<?php

namespace Modules\User\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Session;
use App\PrinterDetails;
use App\MyOrders;

class UserController extends Controller
{
    public function get_login()
    {
        if (auth()->check()){
            return redirect()->route('home');
        }else{
            return view('user::login');
        }
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        $remember = $request->remember ? 1 : 0;
        if (auth()->attempt(['email'=>$request->email,'password'=>$request->password],$remember)){
            return redirect()->route('home');
        }else{
            Session::flash('message', 'خطأ في البريد الالكتروني او كلمه المرور');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }

    public function get_logout()
    {
        auth()->logout();
        return redirect('get/login');
    }

    public function super_admin_index()
    {
        $rows = User::where('role_id','=',1)->get();
        if (auth()->user()->role_id == 1) { 
            return view('user::super_admin_index',compact('rows'));
        }else{
            abort(404);
        }
    }

    public function owner_admin_index()
    {
        $rows = User::where('role_id','=',3)->get();
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) { 
            return view('user::owner_admin_index',compact('rows'));
        }else{
            abort(404);
        }
    }

    public function profile($id)
    {
        $row = User::find($id);
        if ($row->id == auth()->user()->id) {
            return view('user::profile',compact('row'));
        }else{
            abort(404);
        }
    }

    public function profile_update($id, Request $request)
    {
        $data = $request->validate([
            'name'  => 'required',
            'email' => 'required',
        ]);

        if ($request->password !== null ){
            $data['password'] = bcrypt($request->password);
        }
        $data = array_filter($data);
        //dd($request->role_id);
        $user = User::find($id);
        $user->update($data);
        Session::flash('message', 'تم تعديل ملفك الشخصي بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function sub_owner_admin_index()
    {
        if (auth()->user()->role_id == 5) {
            abort(404);   
        }else{
            if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 ){
                $rows = User::with(['user'])->where('role_id','=',5)->get();
                //dd($rows);
            }else{
                $rows = User::with(['user'])->where('role_id','=',5)->where('user_id' ,'!=',null)->where('user_id','=',auth()->user()->id)->get();
                //dd($rows);
            }
        }

        return view('user::sub_owner_admin_index',compact('rows'));
    }

    public function customer()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $rows = User::where('role_id','=',4)->get();
        }elseif (auth()->user()->role_id == 3) {

            // start user's coustomer    

        
            $printers = PrinterDetails::with(['user'])
            ->where('user_id','=',auth()->user()->id)
            ->get();
            //dd($printers);
            $printerArray=[];
            $Counter = 0;
            foreach ($printers as $printer) {
                
                    $printerArray[$Counter] = $printer->id;
                    $Counter++;
                
            }
            //dd($printerArray);
            $orders = MyOrders::whereIn('printer_id',$printerArray)->get();
            //dd($orders);

            $usersArray=[];
            $usersCounter = 0;
            foreach ($orders as $order) {
                
                    $usersArray[$usersCounter] = $order->user_id;
                    $usersArray++;
                
            }


            $rows = User::with(['user'])->whereIn('id', $usersArray)->get();

            // end user's coustomer
        }else{
            abort(404);
        }
        return view('user::customer_index',compact('rows'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user::create',compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email'=> 'required|unique:users',
            'password' => 'required|min:6',
            'role_id'=>'required',
        ]);

        $data['password'] = bcrypt($request->password);

        if(auth()->user()->role_id == 3 || auth()->user()->role_id == 2){
            $data['user_id'] = auth()->user()->id;
        }

        $data = array_filter($data);
        //dd($request->role_id);
        $user = User::create($data);

        Session::flash('message', 'تم حفظ عضو جديد بنجاح');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $roles = Role::all();
        $row = User::find($id);
        return view('user::edit',compact('row','roles'));
    }

    public function update($id,Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email'=> 'required|unique:users,email,'.$id,
            'password' => 'sometimes',
            'role_id'=>'required',
        ]);

        if ($request->password !== null ){
            $data['password'] = bcrypt($request->password);
        }
        $data = array_filter($data);
        //dd($request->role_id);
        $user = User::find($id);
        $user->update($data);
        Session::flash('message', 'تم تعديل العضو بنجاح');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();


        Session::flash('message', 'تم حذف العضو بنجاح');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
