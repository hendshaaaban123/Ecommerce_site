@extends('layouts.admin')
@section('content')
<div class="card">

        <div class="card-header">
            <h3>Add Category</h3>
            <a href="{{route('categories.index')}}" class="btn btn-danger btn-sm text-white float-right">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{Route('categories.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">
               <div class="mb-3 col-md-6">
                <label  class="form-label">Name</label>
                   <input type="text" name="name" class="form-control border border-secondry border-2">

               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Slug</label>
                   <input type="text" name="slug" class="form-control border border-secondry border-2" id="exampleInputPassword1">

               </div>

               <div class="mb-3 col-md-6">
                <label for="">Description</label>
               <textarea name="description" class="form-control border border-secondry border-2" rows="3"></textarea>
               </div>


               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Title</label>
                   <input type="text" name="meta_title" class="form-control border border-secondry border-2" id="exampleInputPassword1">
               </div>
               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Keywords</label>
                   <textarea type="text" name="meta_keywords" class="form-control border border-secondry border-2" id="exampleInputPassword1"></textarea>
               </div>

               <div class="mb-3 col-md-6">
                <label for="exampleInputPassword1" class="form-label">Meta Description</label>
                   <textarea type="text" name="meta_desc" class="form-control border border-secondry border-2" id="exampleInputPassword1"></textarea>
               </div>
               <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" name="image" class="form-control border border-secondry border-2" id="exampleInputPassword1">
            </div>

            <div class="mb-3 form-check col-md-6">
                <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">status</label>
              </div>

              <div class="mb-3 form-check col-md-6">
                <input type="checkbox" name="popular" class="form-check-input" id="exampleCheck1">
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
