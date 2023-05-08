@extends('layouts.admin')
@section('content')
<div class="card">

        <div class="card-header">
            <h3>Edit Product</h3>
            <a href="{{route('products.index')}}" class="btn btn-danger btn-sm text-white float-right">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{Route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
               <div class="col-md-6 mb-5">
                <select class="form-select  border border-secondry border-2" name="category_id" aria-label="Default select example">
                <option value="">{{$product->category->name}}</option>

                </select>
               </div>

               <div class="row">
               <div class="mb-3 col-md-6">
                <label  class="form-label">Name</label>
                   <input type="text" name="name" value="{{$product->name}}" class="form-control border border-secondry border-2">

               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Slug</label>
                   <input type="text" name="slug"  value="{{$product->slug}}"  class="form-control border border-secondry border-2" id="exampleInputPassword1">

               </div>

               <div class="mb-3 col-md-6">
                <label for="">Description</label>
               <textarea name="description"   class="form-control border border-secondry border-2" rows="3">{{$product->description}}</textarea>
               </div>

               <div class="mb-3 col-md-6">
                <label for="">Small Description</label>
               <textarea name="small_description"   class="form-control border border-secondry border-2" rows="3">{{$product->small_description}}</textarea>
               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Title</label>
                   <input type="text" name="meta_title"  value="{{$product->meta_title}}"  class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Keywords</label>
                   <textarea type="text" name="meta_keywords"  class="form-control border border-secondry border-2" id="exampleInputPassword1">{{$product->meta_keywords}}</textarea>
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Description</label>
                   <textarea type="text" name="meta_description" class="form-control border border-secondry border-2" id="exampleInputPassword1">{{$product->meta_description}}</textarea>
               </div>

               <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" name="image" class="form-control border border-secondry border-2" id="exampleInputPassword1">
                @if($product->image)
                <img src="{{asset("$product->image")}}" alt="slider"
                     style="width:70px; height:70px;border-radius: 50% 50%;">
                     @endif
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Original Price</label>
                   <input type="number" name="original_price" value="{{$product->original_price}}" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Selling Price</label>
                   <input type="number" name="selling_price" value="{{$product->selling_price}}" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">tax</label>
                   <input type="number" name="tax" value="{{$product->tax}}" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">quantity</label>
                   <input type="number" name="qty" value="{{$product->qty}}" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>

                <div class="mb-3 form-check col-md-6">
                    <input type="checkbox" {{$product->status == "1" ? 'checked':''}} name="status" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label"  for="exampleCheck1">status</label>
                </div>

              <div class="mb-3 form-check col-md-6">
                <input type="checkbox" {{$product->trending == "1" ? 'checked':''}} name="trending" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">trending</label>
              </div>
               <div>
                   <button type="submit" class="btn btn-primary">Save</button>
               </div>

            </form>

        </div>
           </div>

</div>
@endsection
