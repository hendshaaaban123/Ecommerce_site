@extends('layouts.front')
@section('title')
Welcome
@endsection
@section('content')

<div class="py-3">
    <div class="container">
        <div class="row">
            @foreach($category as $item)
            <div class="col-md-3">
                <a href="{{route('viewCategory',$item->slug)}}">
                <div class="card">
                <img src="{{asset("$item->image")}}" alt="" >
                <div class="card-body">
                    <h5>{{$item->name}}</h5>
                    <p>{{$item->description}}</p>
                </div>

             </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection