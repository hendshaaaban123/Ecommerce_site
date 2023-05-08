@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">

<div class="card">
    <div class="card-body">
        <h3 class="d-inline">CategoryList</h3>
        <a href="{{Route('categories.create')}}" class="btn btn-primary btn-sm text-white float-right">
            Add category
        </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td><img src="{{asset("$category->image")}}" alt="slider"
                     style="width:70px; height:70px;border-radius: 50% 50%;"></td>
                <td>
                    <a href="{{Route('categories.edit',$category->id)}}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <form action="{{Route('categories.destroy',$category->id)}}" method="post">
                        @csrf
                        @method('delete')
                     <input type="submit" value="Delete" class="btn btn-primary"
                     onclick="return confirm('Are you sure you want to delete this slider')">
                    </form>
                </td>

              </tr>
              @endforeach
            </tbody>
        </table>
    </div>

</div>
    </div>
</div>

@endsection
