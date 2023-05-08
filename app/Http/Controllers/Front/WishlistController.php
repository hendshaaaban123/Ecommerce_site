<?php

namespace App\Http\Controllers\Front;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function index(){
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('front.wishlist',compact('wishlist'));
    }
    public function add(Request $request){
     if(Auth::check()){
      $pro_id = $request->input('product_id');
      if(Product::find($pro_id)){
       $wishlist = new Wishlist();
       $wishlist->product_id = $pro_id;
       $wishlist->user_id = Auth::id();
       $wishlist->save();
       return response()->json(['message' => "Product added successfully to wishlist"]); 
      }else{
        return response()->json(['message' => "Product doesn't exist"]);
      }
     }else{
        return response()->json(['message' => "Login to Continue"]);
     }
    }
    public function deleteItem(Request $request){
      if(Auth::check()){
          $pro_id = $request->input('pro_id');
          if(Wishlist::where('product_id',$pro_id)->where('user_id',Auth::id())->exists()){
            $wishItem =  Wishlist::where('product_id',$pro_id)->where('user_id',Auth::id())->first();
            $wishItem->delete();
            return response()->json(['message' => "product Deleted Successfully"]);
              
          }

      }else{
          return response()->json(['message' => "Login to continue"]);

      }

  }
  public function loadWish(){
    $wishCount = Wishlist::where('user_id',Auth::id())->count();
    return response()->json(['count'=> $wishCount]);
  }
}
