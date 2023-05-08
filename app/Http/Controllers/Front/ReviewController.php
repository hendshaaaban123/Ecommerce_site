<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    public function add($product_slug){
        $product = Product::where('slug',$product_slug)->where('status','0')->first();
        if($product){
         $product_id = $product->id;
         $review= Review::where('product_id',$product_id)->where('user_id',Auth::id())->first();
         if($review){
           return view('front.reviews.edit',compact('review'));
         }else{
            $verified_purchace = Order::where('orders.user_id',Auth::id())
         ->join('order_items','orders.id','order_items.order_id')
         ->where('order_items.pro_id',$product_id)->get();
         return view('front.reviews.index',compact('product','verified_purchace'));
         }
       
        }else{
            return redirect()->back()->with('message','The Link You follow was broken');
        }
    }

    public function create(Request $request){
     $product_id = $request->input('product_id');
     $product = Product::where('id',$product_id)->where('status','0')->first();
     if($product){
        $user_review = $request->input('user_review');
        $new_review =Review::create([
            'user_id' =>Auth::id(),
            'user_review'=> $user_review,
            'product_id' => $product_id
        ]);
        $category_slug = $product->category->slug;
        $product_slug = $product->slug;
        if($new_review){
            return redirect('viewCategory/'.$category_slug.'/'.$product_slug)->with('message','Thank you for writing your review');
        }
         }else{
        return redirect()->back()->with('message','The link you follow was broken');
     }
     
    }
    public function edit($product_slug){
        $product = Product::where('slug',$product_slug)->where('status','0')->first();
        if($product){
            $product_id = $product->id;
            $review = Review::where('product_id',$product_id)->where('user_id',Auth::id())->first();
            if($review){
                return view('front.reviews.edit',compact('review'));
            }else{
                return redirect()->back()->with('message','The link you followed was broken');
            }
        }
    }
    public function update(Request $request){
        $user_review = $request->input('user_review');
        if($user_review != ''){
            $review_id = $request->input('review_id');
            $my_review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($my_review){
                $my_review->product_id =$review_id;
                $my_review->user_review = $user_review;
                $my_review->update();
                return redirect('viewCategory/'.$my_review->product->category->slug.'/'.$my_review->product->slug)
                ->with('message','Your Review updated successfully');
            }else{
                return redirect()->back()->with('message','The link you follow was broken');
            }
        }else{
            return redirect()->back()->with('message','the review can not be empty');
        }

    }
}
