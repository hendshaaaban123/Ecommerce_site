@extends('layouts.admin')
@section('content')
<div class="card">

        <div class="card-header">
            <h3>Edit Category</h3>
            <a href="{{route('categories.index')}}" class="btn btn-danger btn-sm text-white float-right">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{Route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <div class="row">
               <div class="mb-3 col-md-6">
                <label  class="form-label">Name</label>
                   <input type="text" value="{{$category->name}}" name="name" class="form-control border border-secondry border-2">

               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Slug</label>
                   <input type="text" value="{{$category->slug}}" name="slug" class="form-control border border-secondry border-2" id="exampleInputPassword1">

               </div>

               <div class="mb-3 col-md-6">
                <label for="">Description</label>
               <textarea name="description"  class="form-control border border-secondry border-2" rows="3">{{$category->description}}</textarea>
               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Title</label>
                   <input type="text" value="{{$category->meta_title}}" name="meta_title" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>
               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Keywords</label>
                   <textarea type="text" name="meta_keywords" class="form-control border border-secondry border-2" id="exampleInputPassword1">{{$category->meta_keywords}}</textarea>
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Description</label>
                   <textarea type="text" name="meta_desc" class="form-control border border-secondry border-2" id="exampleInputPassword1">{{$category->meta_desc}}</textarea>
               </div>
               <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" name="image"  class="form-control border border-secondry border-2" id="exampleInputPassword1">
                @if($category->image)
                <img src="{{asset("$category->image")}}" alt="slider"
                     style="width:70px; height:70px;border-radius: 50% 50%;">
                     @endif
            </div>

            <div class="mb-3 form-check col-md-6">
                <input type="checkbox" {{$category->status == "1" ? 'checked':''}} name="status" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">status</label>
              </div>

              <div class="mb-3 form-check col-md-6">
                <input type="checkbox" {{$category->popular == "1" ? 'checked':''}} name="popular" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">popular</label>
              </div>
               <div>
                   <button type="submit" class="btn btn-primary">Save</button>
               </div>

            </form>

        </div>
           </div>

</div>
@endsection
