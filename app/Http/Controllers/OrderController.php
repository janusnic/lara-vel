<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)     {
        $this->orderRepository = $orderRepository;
    }

    public function checkout()    {
        $tax = 0.07;
        return view('main.checkout', ['tax' => $tax]);
    }

    public function placeOrder(Request $request)     {
        $order = $this->orderRepository->storeOrderDetails($request->all());
        // dd($order);
        
        if ($order) {
            \Cart::clear();
            return view('main.success', ['order' => $order]);

        }
        return redirect()->back()->with('message','Order not placed');
    }
    
}
