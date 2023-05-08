<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $product = Product::where('trending', '1')->take(15)->get();
        $category = Category::where('status', '1')->take(15)->get();
        return view('front.index', compact('product','category'));
    }
    public function category()
    {
        $category = Category::where('status', '1')->take(15)->get();
        return view('front.category',compact('category'));
    }
    public function viewCategory($slug){
        if(Category::where('slug',$slug)->exists())
        {
        $category = Category::where('slug',$slug)->first();
        $products = Product::where('category_id',$category->id)->where('status','0')->get();
        return view('front.products.index',compact('category','products'));
        }else{
            return redirect('/')->with('message','slug does not exits');
        }
    }
    public function viewproduct($cat_slug,$pro_slug){

    if(Category::where('slug',$cat_slug)->exists())
    {
        if(Product::where('slug',$pro_slug)->exists()){
            $product = Product::where('slug',$pro_slug)->first();
            $rating = Rating::where('product_id',$product->id)->get();
            $rating_sum = Rating::where('product_id',$product->id)->sum('stars_rated');
            $user_rating =Rating::where('product_id',$product->id)->where("user_id",Auth::id())->first();
            $review = Review::where('product_id',$product->id)->get();
            if($rating->count() > 0){
                $rating_value = $rating_sum / $rating->count();
  
            }else{
                  $rating_value = 0;
            }
            return view('front.products.view',compact('product','review','rating','rating_value','user_rating'));

        }else{
            return redirect('/')->with('message','The link was broken');
 
        }

    }else{
        return redirect('/')->with('message','No such category found');


    }
    }
    public function productList(){
        $product = Product::select('name')->where('status','0')->get();
        $data= [];
        foreach($product as $item){
            $data[] = $item['name'];

        }
        return $data;
    }
    public function searchProduct(Request $request){
      $searched_product = $request->input('product_name');
      if($searched_product != ""){
      $product = Product::where("name","LIKE","%$searched_product")->first();
      if($product){
        return redirect('viewCategory/'.$product->category->slug.'/'.$product->slug);
      }else{
        return redirect()->back()->with('message','No product matches your search');
      }
      }else{
        return redirect()->back();
      }
    }
}
