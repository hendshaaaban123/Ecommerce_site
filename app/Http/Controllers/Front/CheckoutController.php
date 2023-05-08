<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index()
{
    $old_cartitems = Cart::where('user_id',Auth::id())->get();
    foreach($old_cartitems as $item){
        if(!Product::where('id',$item->product_id)->where('qty','>=',$item->product_qty)->exists()){
            $removeItem = Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
            $removeItem->delete();
        }
    }



    $cartItems = Cart::where('user_id',Auth::id())->get();

    return view('front.checkout',compact('cartItems'));
}
public function placeOrder(Request $request){
    $order = new Order();
    $order->user_id = Auth::id();
    $order->fname = $request->input('fname');
    $order->lname = $request->input('lname');
    $order->email = $request->input('email');
    $order->phone = $request->input('phone');
    $order->adress1 = $request->input('adress1');
    $order->adress2= $request->input('adress2');
    $order->city = $request->input('city');
    $order->state = $request->input('state');
    $order->country = $request->input('country');
    $order->pincode= $request->input('pincode');
    $order->payment_mode= $request->input('payment_mode');
    $order->payment_id= $request->input('payment_id');
    $order->tracking_no = 'sharma'.rand(1111,9999);
    $total = 0;
    $myCartItems = Cart::where('user_id',Auth::id())->get();
    foreach($myCartItems as $mycart){
        $total += $mycart->products->selling_price;

    }
    $order->total_price = $total;

    $order->save();
    $cartItems = Cart::where('user_id',Auth::id())->get();
    foreach($cartItems as $item){
        OrderItem::create([
            'order_id'=>$order->id,
            'pro_id'=>$item->product_id,
            'qty'=>$item->product_qty,
            'price'=> $item->products->selling_price,

        ]);
        $pro=Product::where('id',$item->product_id)->first();
        $pro->qty = $pro->qty - $item->product_qty;
        $pro->update();
        
    }
    if(Auth::user()->adress1 == null){
        $user= User::where('id',Auth::id())->first();
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->adress1 = $request->input('adress1');
        $user->adress2= $request->input('adress2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pincode= $request->input('pincode');
        $user->update();
    }
    $cart = Cart::where('user_id',Auth::id())->get();
    Cart::destroy($cart);
        
        return response()->json(['message'=> 'order placed successfully']);
   


}
public function pay(Request $request){
$cartItems = cart::where('user_id',Auth::id())->get();
$total_price =0;
foreach($cartItems as $item){
    $total_price += $item->products->selling_price * $item->product_qty;
}

$firstname = $request->input('fname');
$lastname = $request->input('lname');
$email = $request->input('email');
$phone = $request->input('phone');
$adress1 = $request->input('adress1');
$adress2= $request->input('adress2');
$city = $request->input('city');
$state = $request->input('state');
$country = $request->input('country');
$pincode= $request->input('pincode');
return response()->json([
               'firstname'=>$firstname,
                'lastname'=>$lastname,
                'email'=>$email,
                'phone'=>$phone,
                'adress1'=>$adress1,
                'adress2'=>$adress2,
                'city'=>$city,
                'country'=>$country,
                'state'=>$state,
                'pincode'=>$pincode,
                'total_price'=>$total_price
]);

}
}
