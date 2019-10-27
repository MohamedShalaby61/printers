<?php

namespace Modules\Printer\Http\Controllers;

use App\PrinterDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2){
            $rows = PrinterDetails::with(['user'])->get();
        }
        elseif(auth()->user()->role_id == 3){
            $rows = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->id)->get();
        }else{
            $rows = PrinterDetails::with(['user'])->where('user_id','=',auth()->user()->user_id)->get();
        }

        
 
            return view('printer::index',compact('rows'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $users = User::query()
            ->where('role_id','=','2')
            ->orWhere('role_id','=','3')
            ->get();
        return view('printer::create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'logo'    => 'sometimes',
            'user_id' => 'required',
        ]);

        if ($request->logo){
            $file = $request->file('logo');
            $destinationPath = 'storage/printers';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $data['logo'] = $filename;
        }else{
            $data['logo'] = 'default.png';
        }

        $printer = PrinterDetails::create($data);

        Session::flash('message', 'تم اضافة مطبعة بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('printers.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('printer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = PrinterDetails::find($id);
        $users = User::query()
            ->where('user_id','=',null)
            ->where('role_id','=','3')
            ->orWhere('role_id','=','2')
            ->get();
        return view('printer::edit',compact('row','users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'logo'    => 'sometimes',
            'user_id' => 'required',
        ]);

        if ($request->logo){
            $file = $request->file('logo');
            $destinationPath = 'storage/printers';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $data['logo'] = $filename;
        }

        $printer = PrinterDetails::find($id);
        $printer->update($data);

        Session::flash('message', 'تم تعديل المطبعة بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('printers.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $printer = PrinterDetails::find($id);
        $printer->delete();
        Session::flash('message', 'تم حذف المطبعة بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('printers.index');
    }
}
