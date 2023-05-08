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
            <a href="{{route('cart')}}">
               
           Cart
            </a>
            </h6>
        </div>
    
    </div>
    <div class="card shadow ">
      @if($cartItem->count() > 0)
       <div class="card-body">
         @php $total =0; @endphp
        @foreach($cartItem as $item)
          <div class="row mb-3 product_data">
             <div class="col-md-2">
               
                <img src="{{asset(`uploads/product`.$item->products->image)}}" class="rounded-2" height="70px" width="70px" alt="Image here">
             </div>
             <div class="col-md-3">
                <h3>{{$item->products->name}}</h3>
             </div>
             <div class="col-md-2">
               <h3>Rs {{$item->products->selling_price}}</h3>
            </div>
             <div class="col-md-3">
                <div  style="width:130px;  display: flex;
                align-items: center;">
               <input type="hidden" value="{{$item->product_id}}" class="pro_id">
               @if($item->products->qty >= $item->product_qty)
                    {{-- <span class="me-5 fw-bold">Quantity</span> --}}
                    <button class="decrement-btn changeqty btn btn-secondary">-</button>
                    <input type="text" name="quantity" style="width:100px"  class="form-control qty-input text-center border-top border-bottom border-secondry border-1 mb-3" value="{{$item->product_qty}}">
                    <button class="increment-btn changeqty btn btn-secondary">+</button>
                    @php $total +=$item->products->selling_price*$item->product_qty; @endphp

                 @else
                
                 <h6>Out Of Stock</h6>
                 @endif
                </div>
             </div>
             <div class="col-md-2">
                 <button class="btn btn-danger delete_button">Delete  <i class="fa fa-trash"></i></button>
             </div>
          </div>
          @endforeach
       
         </div>
       <div class="card-footer">
       <h3>Total price : {{$total}}
         <a class="btn btn-outline-success float-end" href="{{route('checkout')}}">Procceed to checkout</a>
      
      </h3>
       
       </div>
       @else
       <div class="card-body text-center">
         <h2>Your <i class="fa fa-shopping-cart"></i>cart is empty</h2>
         <a href="{{route('category')}}" class="btn btn-outline-primary float-end">continue shopping</a>
       </div>
       @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
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

 $('.delete_button').click(function(e){
e.preventDefault();
var pro_id = $(this).closest('.product_data').find('.pro_id').val();

$.ajax({
   method:"POST",
   url:"/delete_button",
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

 $('.changeqty').click(function(e){
   e.preventDefault();
   var pro_id = $(this).closest('.product_data').find('.pro_id').val();
   var qty = $(this).closest('.product_data').find('.qty-input').val();
   data ={
      'pro_id':pro_id,
      'qty':qty,
   }
$.ajax({
   method:"POST",
   url:"/update-cart",
   data:data,
   success:function(response){
      window.location.reload();
   }
})


 })
});
</script>
@endsection