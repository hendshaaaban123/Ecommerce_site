<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create(){
     return view('admin.category.create');
    }
    public function store(Request $request){

    $category = new Category();
    if($request->hasFile('image')){
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;
        $file->move('uploads/slider/',$filename);
        $category->image="uploads/slider/$filename";
    }
    
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->meta_title = $request->meta_title;
    $category->meta_keywords = $request->meta_keywords;
    $category->meta_desc= $request->meta_desc;
    $category->status = $request->status == TRUE ? '1':'0';
    $category->popular = $request->popular == TRUE ? '1':'0';
    $category->save();
    return redirect('/categories')->with('message','category added successfully');
    }

    public function edit(Category $category){
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,Category $category){
        if($request->hasFile('image')){
            $distination = $category->image;
            if(File::exists($distination)){
                File::delete($distination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $category->image="uploads/slider/$filename";
        }
        Category::where('id',$category->id)->update([
        'description' =>$request->description,
        'slug'=>$request->slug,
        'meta_keywords'=>$request->meta_keywords,
        'meta_title'=>$request->meta_title,
        'meta_desc' =>$request->meta_desc,
        'image' =>$category->image,
        'name' =>$request->name,
        'status'=>$request->status == TRUE ? '1':'0',
        'popular'=>$request->popular == TRUE ? '1':'0'
    ]);
        //  return "added";
        return redirect('/categories')->with('message','Category updated Successfuly');

    }
    public function destroy($id){
        $category = Category::find($id);
        if($category->image){
            $distination = $category->image;
            if(File::exists($distination)){
                File::delete($distination);
            }
        }
        $category->delete();
        return redirect()->back()->with('message','category deleted successfully');
    }
}
