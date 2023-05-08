<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('front.orders.index',compact('orders'));
    }
    public function view($id){
        $order = Order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('front.orders.view',compact('order'));

    }
}
