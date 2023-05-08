<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::where('status','0')->get();
        return view('admin.orders.index',compact('orders'));
    }
    public function show($id){
        $order = order::where('id',$id)->first();
        return view('admin.orders.show',compact('order'));
    }
    public function update(Request $request,$id){
        $order = Order::find($id);
        $order->status = $request->input('order_status');
        $order->update();
        return redirect('orders')->with('message','order updated successfully');
    }
    public function orderHistory(){
        $orders = Order::where('status','1')->get();
        return view('admin.orders.history',compact('orders'));
    }
}
