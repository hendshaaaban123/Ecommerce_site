<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    //
    public function add(Request $request){
    $stars = $request->input('product_rating');
    $product_id = $request->input('product_id');
    $product_check = Product::where('id',$product_id)->where('status','0')->first();
    if($product_check){
        $verified_purchace = Order::where('orders.user_id',Auth::id())
        ->join('order_items','orders.id','order_items.order_id')
        ->where('order_items.pro_id',$product_id)->get();
        if($verified_purchace){
            $exiting_rating = Rating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if($exiting_rating ){

                $exiting_rating->stars_rated = $stars;
                $exiting_rating->update();
            }else{
                Rating::create([
                    'user_id'=>Auth::id(),
                    'product_id'=>$product_id,
                    'stars_rated'=>$stars
                 ]);

            }
            return redirect()->back()->with('message','Thank you for rating this product');
  
        
        }else{
         return redirect()->back()->with('message','You can not rate this product without purchase');
        }
    }else{
        return redirect()->back()->with('message','YThe link you followed was broken');
  
    }
    }
}
