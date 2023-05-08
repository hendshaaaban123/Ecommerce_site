@extends('layouts.front')
@section('title')
Write A Review
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>You are writing a review for {{$review->product->name}}</h4>
                    <form action="{{Route('updateReview')}}" method="post">
                        @csrf
                        @method('PUT')
                     <input type="hidden" name="review_id" value="{{$review->id}}">
                     <textarea name="user_review" rows="5" class="form-control border border-secondry border-1 mb-2 p-2"
                      placeholder="Write A Review">{{$review->user_review}}</textarea>
                     <button type="submit" class="btn btn-success">Update Review</button>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection