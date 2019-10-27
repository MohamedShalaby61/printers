<?php

namespace Modules\Offer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Offer\Entities\Offer;
use Session;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $rows = Offer::all();
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            return view('offer::index',compact('rows'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            return view('offer::create');
        }else{
            abort(404);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'photo'   => 'sometimes',
            'code'    => 'required',
            'count'   => 'required|integer',
            'started_at'    => 'required|date_format:Y-m-d',
            'ended_at'    => 'required|date_format:Y-m-d',
        ]);

        if ($request->photo){
            $file = $request->file('photo');
            $destinationPath = 'storage/offers';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $data['photo'] = url('storage/offers/'.$filename);
        }else{
            $data['photo'] = url('storage/offers/default.png');
        }

        $printer = Offer::create($data);

        Session::flash('message', 'تم اضافة عرض بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('offers.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('offer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = Offer::find($id);
        return view('offer::edit',compact('row'));
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
            'title'    => 'required',
            'content' => 'required',
            'photo'    => 'sometimes',
            'code'    => 'required',
            'count'   => 'required|integer',
            'started_at'    => 'required|date_format:Y-m-d',
            'ended_at'    => 'required|date_format:Y-m-d',
        ]);

        if ($request->photo){
            $file = $request->file('photo');
            $destinationPath = 'storage/offers';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $data['photo'] = url('storage/offers/'.$filename);
        }

        $printer = Offer::find($id);
        $printer->update($data);

        Session::flash('message', 'تم تعديل العرض بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        Session::flash('message', 'تم حذف العرض بنجاح');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('offers.index');
    }
}
