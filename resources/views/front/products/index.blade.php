@extends('layouts.front')
@section('title')
Products
@endsection
@section('content')

<div class="py-3">
    <div class="container">
    <div class="row">
        <h2>category name:{{$category->name}}</h2>
        
            @foreach($products as $item)
             <div class="col-md-3 mb-3">
            <a href="{{url('viewCategory/'.$category->slug."/".$item->slug)}}">

            <div class="card">

               <img src="{{asset("$item->image")}}" alt="" >

               <div class="card-body">
                <h5>{{$item->name}}</h5>
                <small class="float-start">{{$item->selling_price}}</small>
                <small class="float-end"><s>{{$item->original_price}}</s></small>
               </div>

            </div>
            </a>
            </div>
            
            @endforeach

        

    </div>

    </div>

</div>

@endsection