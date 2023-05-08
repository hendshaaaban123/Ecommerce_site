@extends('layouts.front')
@section('title')
Edit your Review
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>You are writing a review for {{$product->name}}</h4>
                    @if($verified_purchace->count()>0)
                    <form action="{{Route('addReview')}}" method="post">
                        @csrf
                     <input type="hidden" name="product_id" value="{{$product->id}}">
                     <textarea name="user_review" rows="5" class="form-control border border-secondry border-1 mb-2 p-2" 
                     placeholder="Write A Review"></textarea>
                     <button type="submit" class="btn btn-success">Submit Review</button>
                    </form>
                    @else
                    <h5>
                        You are not eligible to review this product
                    </h5>
                    <p>
                        For the trustworth ,Only customers who purchased The product can review this product.
                    </p>
                    <a href="{{url('/')}}" class="btn btn-primary">Go to the Home Page</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection