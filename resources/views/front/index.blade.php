@extends('layouts.front')
@section('title')
Welcome
@endsection
@section('content')
@include('layouts.inc.frontslider')
<div class="py-3">
    <div class="container">
    <div class="row">
        <h2>Featured products</h2>
        <div class="featured-coursal owl-carousel owl-theme">
            @foreach($product as $item)
            <div class="item">
            <div class="card">

               <img src="{{asset("$item->image")}}" alt="" width="200px" height="200px">

               <div class="card-body">
                <h5>{{$item->name}}</h5>
                <small class="float-start">{{$item->selling_price}}</small>
                <small class="float-end"><s>{{$item->original_price}}</s></small>
               </div>

            </div>
            </div>
            @endforeach

        </div>

    </div>

    </div>

</div>
<div class="py-3">
    <div class="container">
    <div class="row">
        <h2>Featured Categories</h2>
        <div class="featured-coursal owl-carousel owl-theme">
            @foreach($category as $item)
            <a href="{{route('viewCategory',$item->slug)}}">
            <div class="item">
               
                <div class="card">

               <img src="{{asset("$item->image")}}" alt="">
                 
                <div class="card-body">
                <h5>{{$item->name}}</h5>
                <p>{{$item->description}}</p>
               </div>

            </div>
                
            </div>
            </a>
            @endforeach

        </div>

    </div>

    </div>

</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.featured-coursal').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})

    })
   
</script>
@endsection

