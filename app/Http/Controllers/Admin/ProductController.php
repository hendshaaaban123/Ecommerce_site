<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $category = Category::all();
        return view('admin.product.create',compact('category'));
    }
    public function store(Request $request){
        $product = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/product/',$filename);
            $product->image="uploads/product/$filename";
        }
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->small_description = $request->small_description;
        $product->meta_title = $request->meta_title;
        $product->original_price = $request->original_price;
        $product->selling_price = $request->selling_price;
        $product->tax = $request->tax;
        $product->qty = $request->qty;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description= $request->meta_description;
        $product->status = $request->status == TRUE ? '1':'0';
        $product->trending = $request->trending == TRUE ? '1':'0';
        $product->save();
        return redirect('/products')->with('message','product added successfully');

    }
    public function edit(Product $product){
        return view('admin.product.edit',compact('product'));
    }
    public function update(Request $request,Product $product){
        if($request->hasFile('image')){
            $distination = $product->image;
            if(File::exists($distination)){
                File::delete($distination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/product/',$filename);
            $product->image="uploads/product/$filename";
        }
        Product::where('id',$product->id)->update([
           'small_description' => $request->small_description,
            'description' =>$request->description,
            'slug'=>$request->slug,
            'meta_keywords'=>$request->meta_keywords,
            'meta_title'=>$request->meta_title,
            'meta_description' =>$request->meta_description,
           'original_price' => $request->original_price,
            'selling_price' => $request->selling_price,
            'tax' => $request->tax,
            'qty' => $request->qty,
            'image' =>$product->image,
            'name' =>$request->name,
            'status'=>$request->status == TRUE ? '1':'0',
            'trending'=>$request->trending == TRUE ? '1':'0'
        ]);
        return redirect('/products')->with('message','product updated successfully');
    }
    public function destroy($id){
        $product = Product::find($id);
        if($product->image){
            $distination = $product->image;
            if(File::exists($distination)){
                File::delete($distination);
            }
        }
        $product->delete();
        return redirect()->back()->with('message','product deleted successfully');
    }
}
