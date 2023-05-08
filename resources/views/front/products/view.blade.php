@extends('layouts.front')
@section('title',$product->name)

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('add-rating')}}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Rate {{$product->name}} </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="rating-css">
          <div class="star-icon">
            @if($user_rating)
            @for($i=1 ;$i<=$user_rating->stars_rated; $i++)
            <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
            <label for="rating{{$i}}" class="fa fa-star"></label>
            @endfor
            @for($j = $user_rating->stars_rated+1 ; $j<=5 ; $j++)
            <input type="radio" value="{{$j}}" name="product_rating" id="rating{{$j}}">
            <label for="rating{{$j}}" class="fa fa-star"></label>
            @endfor
            @else
              <input type="radio" value="1" name="product_rating" checked id="rating1">
              <label for="rating1" class="fa fa-star"></label>
              <input type="radio" value="2" name="product_rating" id="rating2">
              <label for="rating2" class="fa fa-star"></label>
              <input type="radio" value="3" name="product_rating" id="rating3">
              <label for="rating3" class="fa fa-star"></label>
              <input type="radio" value="4" name="product_rating" id="rating4">
              <label for="rating4" class="fa fa-star"></label>
              <input type="radio" value="5" name="product_rating" id="rating5">
              <label for="rating5" class="fa fa-star"></label>
              @endif
          </div>
        
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="py-3 mb-4 shadow-sm bg-secondary border-top">
    <div class="container">
      <h6 class="mb-0">
        <a href="{{route('category')}}">
        Collections
        </a>/
        <a href="{{route('viewCategory',$product->category->slug)}}">
           
        {{$product->category->name}}
        </a>/
        <a href="{{url('viewCategory/'.$product->category->slug."/".$product->slug)}}">

        {{$product->name}}
    </a></h6>
    </div>

</div>
<div class="container">
    <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded product_data">
      <div class="card-body">
        <div class="row">
            <div class="col-md-4 border-right mt-3">
               <img src="{{asset("$product->image")}}" alt="Name" class="w-100 rounded-2" >
            </div>
            <div class="col-md-8">
                <h2 class="mb-0">
                  {{$product->name}}
                  @if($product->trending == '1')
                    <label for="" style="font-size:16px;" class="float-end badge bg-danger trending-tag">Trending</label>
                    @endif
                </h2>
                <hr class="bg-secondary">
                <label for="" class="me-3">Original Price: <s>{{$product->original_price}}</s></label>
                <label for="" class="fw-bold">Selling Price:{{$product->selling_price}}</label>
                @php $rating_value = number_format($rating_value) @endphp
                <div class="rating">
                  @for($i=1 ;$i<=$rating_value ; $i++)
                 <i class="fa fa-star checked"></i>
                 @endfor
                 @for($j = $rating_value+1 ; $j<=5 ; $j++)
                 <i class="fa fa-star"></i>
                 @endfor
                 @if($rating->count() >0)
                 <span>  {{$rating->count()}} Ratings</span>
                 @else
                 <span>No Ratings</span>
                 @endif
                </div>
              
                <p class="mt-3">
                      {!! $product->small_description !!}
                </p>
                <hr class="bg-secondary">
                @if($product->qty > 0)
                <label for="" class="badge bg-success">In Stock</label>
                 @else
                 <label for="" class="badge bg-danger">Out of stock</label>
                 @endif
                 <div class="row mt-2">
                      <div class="col-md-2">
                        <label for="Quantity">Quantity</label>
                        <input type="hidden" value="{{$product->id}}" class="pro_id">
                        <div class="input-group text-center mb-3">
                            <input type="number" value="1" name="quantity" class="form-control qty_input border border-secondry border-2">

                        </div>
                      </div>
                      <div class="col-md-10">
                        <br/>
                        @if($product->qty > 0)
                        <button type="button" class="btn btn-primary addToCart me-3 float-start">Add to Cart <i class="fa fa-shopping-cart ms-3"></i></button>
                         @endif
                        <button type="button" class="btn btn-success addToWish me-3 float-start">Add to wishlist<i class="fa fa-heart ms-3"></i></button>

                      </div>
                 </div>
            </div>

        </div>
        <div class="col-md-12">
          <hr class="bg-secondary">
           <label for="" class="mb-3">Description</label>
           <p>{{$product->description}}</p>
        </div>
        <hr class="bg-secondary">
        <div class="row">
         <div class="col-md-4">
           
           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Rate this product
          </button>
          <a href="{{url('add-review/'.$product->slug.'/userreview')}}" class="btn btn-success" >
            Write a review
          </a>
           
         </div>
         <div class="col-md-8">
          @foreach($review as $item)
          <div class="user-review">
          <label>{{$item->user->name.' '.$item->user->lname}}</label>
          @if($item->user_id == Auth::id())
          <a href="{{url('edit-review/'.$product->slug.'/userreview')}}" >edit</a>
          @endif
          @php $user_rating = $item->rating->stars_rated @endphp
          @if($user_rating)
          <br>
          @for($i=1 ;$i<=$user_rating ; $i++)
          <i class="fa fa-star checked"></i>
          @endfor
          @for($j = $user_rating+1 ; $j<=5 ; $j++)
          <i class="fa fa-star"></i>
          @endfor
          @endif
          <small>{{$item->created_at->format('d M Y')}}</small>
          <p>{{$item->user_review}}</p>
        </div>
        @endforeach
         </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.addToCart ').click(function(e){

        
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.pro_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty_input').val();

                $.ajaxSetup({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });



       $.ajax({
        method:"POST",
        url:"/add-to-cart",
        data:{
            'product_id':product_id,
            'product_qty':product_qty,
        },
        success:function(response){
            swal(response.message);
            loadCart();
        }
       });

    });
    $('.addToWish').click(function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.pro_id').val();

      $.ajaxSetup({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

                
       $.ajax({
        method:"POST",
        url:"/add-to-wishlist",
        data:{
            'product_id':product_id,
        },
        success:function(response){
            sweetAlert(response.message);
            loadWishList();
        }
       });


    });

    })
</script>

@endsection