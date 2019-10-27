<?php

namespace App\Http\Controllers\API;

use App\OrderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderTypeController extends Controller
{
    
    public function index()
    {
        $orderType = OrderType::all();
        return response()->json(['order type' => $orderType]);
    }

    
    
    public function show(OrderType $orderType)
    {
        return $orderType;
    }

}
