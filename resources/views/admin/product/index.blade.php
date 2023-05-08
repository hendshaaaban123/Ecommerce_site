@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">

<div class="card">
    <div class="card-body">
        <h3 class="d-inline">Product List</h3>
        <a href="{{Route('products.create')}}" class="btn btn-primary btn-sm text-white float-right">
            Add product
        </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category Name</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Tax</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>
               
                <td>{{$product->original_price}}</td>
                <td>{{$product->selling_price}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->tax}}</td>
                <td><img src="{{asset("$product->image")}}" alt="slider"
                     style="width:70px; height:70px;border-radius: 50% 50%;"></td>
                <td>
                    <a href="{{Route('products.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <form action="{{Route('products.destroy',$product->id)}}" method="post">
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
