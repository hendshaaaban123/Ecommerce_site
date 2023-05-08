<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
       

        if(Auth::check()){
            $product_check = Product::where('id',$product_id)->first();
            if($product_check){
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['message'=> $product_check->name.' Already added to cart']);
                }
                else{
                $cartItem = new Cart();
                $cartItem->product_id = $product_id;
                $cartItem->product_qty = $product_qty;
                $cartItem->user_id = Auth::id();
                $cartItem->save();
                return response()->json(['message'=> $product_check->name.' added to cart']);
                }
    
            }
            

        }
        else{
            return response()->json(['message'=>'login to continue']);

        }

    }
    public function viewCart(){
        $cartItem = cart::where('user_id',Auth::id())->get();
        return view('front.cart',Compact('cartItem'));
    }
    public function deleteProduct(Request $request){
        if(Auth::check()){
            $pro_id = $request->input('pro_id');
            if(Cart::where('product_id',$pro_id)->where('user_id',Auth::id())->exists()){
              $cartItem =  Cart::where('product_id',$pro_id)->where('user_id',Auth::id())->first();
              $cartItem->delete();
              return response()->json(['message' => "product Deleted Successfully"]);
                
            }

        }else{
            return response()->json(['message' => "Login to continue"]);

        }

    }
    public function updateProduct(Request $request){
        $pro_id = $request->input('pro_id');
        $pro_qty = $request->input('qty');

if(Auth::check()){
    if(Cart::where('product_id',$pro_id)->where('user_id',Auth::id())->exists()){
        $cart = Cart::where('product_id',$pro_id)->where('user_id',Auth::id())->first();
        $cart->product_qty = $pro_qty;
        $cart->update();
        return response()->json(['message'=>'Quantity updated successfully']);
    }else{

    }
}
    }
    public function loadCart(){
        $cartCount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $cartCount]);
    }
}
