<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    
    public function index()
    {
        $orderStatus = OrderStatus::all();
        return response()->json(['order Status' => $orderStatus]);
    }

    
    public function show(OrderStatus $orderStatus)
    {
        return $orderStatus;
    }

}
