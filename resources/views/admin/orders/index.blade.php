@extends('layouts.admin')
@section('title')
orders
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Orders
                        <a href="{{route('order-history')}}" class="btn btn-warning float-end">Order History</a>

                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>order date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                                <td>{{$order->tracking_no}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->status == '0' ? 'pending' : 'completed'}}</td>
                                <td>
                                    <a href="{{route('orders.show',$order->id)}}" class="btn btn-primary ">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection