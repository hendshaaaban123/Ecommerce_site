@extends('layouts.front')
@section('title')
My cart
@endsection
@section('content')
<div class="container">
    <div class="py-3 mb-4 shadow-sm bg-secondary border-top">
        <div class="container">
          <h6 class="mb-0">
            <a href="{{url('/')}}">
            Home
            </a>/
            <a href="{{route('wishlist')}}">
               
           Wishlist
            </a>
            </h6>
        </div>
    
    </div>
    <div class="card shadow product_data">
     
       <div class="card-body">
        @if($wishlist ->count() > 0)
        
        @foreach($wishlist as $item)
          <div class="row mb-3 product_data">
             <div class="col-md-2">
               
                <img src="{{asset(`uploads/product`.$item->products->image)}}" class="rounded-2" height="70px" width="70px" alt="Image here">
             </div>
             <div class="col-md-2">
                <h3>{{$item->products->name}}</h3>
             </div>
             <div class="col-md-2">
               <h3>Rs {{$item->products->selling_price}}</h3>
            </div>
             <div class="col-md-2">
                <div  style="width:130px;  display: flex;
                align-items: center;">
               <input type="hidden" value="{{$item->product_id}}" class="pro_id">
               @if($item->products->qty >= $item->product_id)
               <button class="decrement-btn  btn btn-secondary">-</button>
               <input type="text" name="quantity" style="width:100px"  class="form-control qty-input text-center border-top border-bottom border-secondry border-1 mb-3" value="1">
               <button class="increment-btn  btn btn-secondary">+</button>
                @else
                <h6>Out Of Stock</h6>
                 @endif
                </div>
             </div>
             <div class="col-md-2">
                 <button class="btn btn-danger delete_wishlist">Delete  <i class="fa fa-trash"></i></button>
             </div>
             <div class="col-md-2">
                <button class="btn btn-success addToCart">Add to cart  <i class="fa fa-shopping-cart "></i></button>
            </div>
          </div>
          @endforeach
       
         </div>
        @else
        <h4>There are no products in your wishlist</h4>
        @endif
       </div>
        
       
    </div>
</div>
@endsection
@section('scripts')
<script>
     $(document).ready(function(){
        $('.addToCart').click(function(e){

      
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.pro_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty_input').val();



       $.ajax({
        method:"POST",
        url:"/add-to-cart",
        data:{
            'product_id':product_id,
            'product_qty':product_qty,
        },
        success:function(response){
            swal(response.message);
        }
       });

    });
    $('.increment-btn').click(function(e){
      e.preventDefault();
      var inc_value =$(this).closest('.product_data').find('.qty-input').val();
      var value = parseInt(inc_value,10);
      value = isNaN(value) ? 0 : value;
      if(value < 10)
      {
         value++;
         $(this).closest('.product_data').find('.qty-input').val(value);
      }
      

   });
   $('.decrement-btn').click(function(e){
      e.preventDefault();
      var dec_value = $(this).closest('.product_data').find('.qty-input').val();
      var value = parseInt(dec_value,10);
      value = isNaN(value) ? 0 : value;
      if(value > 1)
      {
         value--;
         $(this).closest('.product_data').find('.qty-input').val(value);
      }
      

   });

 $('.delete_wishlist').click(function(e){
e.preventDefault();
var pro_id = $(this).closest('.product_data').find('.pro_id').val();

$.ajax({
   method:"POST",
   url:"/delete_wishlist",
   data:{
      'pro_id':pro_id,
   },
   success:function(response){
      window.location.reload();
      swal("",response.message,"success");


   }
   
});
 });
 $.ajaxSetup({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

});
</script>    


@endsection