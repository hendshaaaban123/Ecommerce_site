@extends('layouts.front')
@section('title')
Products
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label for="" class="fw-bold">First Name</label>
            <div class="border p-2 mb-3">{{$order->fname}}</div>
            <label for="" class="fw-bold">Last Name</label>
            <div class="border p-2 mb-3">{{$order->lname}}</div>
            <label for="" class="fw-bold">Email</label>
            <div class="border p-2 mb-3">{{$order->email}}</div>
            <label for="" class="fw-bold">Contact no</label>
            <div class="border p-2 mb-3">{{$order->phone}}</div>
            <label for="" class="fw-bold">Shipping Adress</label>
            <div class="border p-2 mb-3">
                {{$order->adress1}},
                {{$order->adress2}},
                {{$order->city}},
                {{$order->country}},
                {{$order->state}},
            </div>
            <label for="" class="fw-bold">Zip code</label>
            <div class="border p-2">{{$order->pincode}}</div>
            
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>My Orders
                        <a href="{{route('my-orders')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                    
                </div>
                <div class="card body">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        @foreach($order->orderitems as $item)
                        <tbody>
                            <tr >
                                <td class="ps-4">{{$item->products->name}}</td>
                                <td class="ps-4">{{$item->qty}}</td>
                                <td class="ps-4">{{$item->price}}</td>
                                <td class="ps-4">
                                    
                                    <img src="{{asset(`uploads/product/`.$item->products->image)}}" alt="image" class="rounded-2" height="50px" width="50px" >
                                </td>
                            </tr>
                           
                        </tbody>
                        @endforeach
        
                    </table>
                </div>
               
            </div>
            <div class="mt-5">
                <h4>Grand Total: {{$order->total_price}}</h4>
            </div>
        </div>
    </div>
</div>
@endsection