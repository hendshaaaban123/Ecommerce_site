@extends('layouts.front')
@section('title')
checkout 
@endsection
@section('content')
<div class="container">
    <form action="{{route('place-order')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6>Basic Details</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstName" class="fw-bold">First Name</label>
                            <input type="text" value="{{Auth::user()->name}}" name="fname" class=" form-control firstname border border-secondry border-2 ps-2" placeholder="Enter first name">
                           <span id="fname_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="fw-bold">Last Name</label>
                            <input type="text"  value="{{Auth::user()->lname}}"  name="lname" class="form-control lastname border border-secondry border-2 ps-2" placeholder="Enter last name">
                            <span id="lname_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="email" class="fw-bold">Email</label>
                            <input type="text"  value="{{Auth::user()->email}}"  name="email" class="form-control email border border-secondry border-2 ps-2" placeholder="Enter your Email">
                            <span id="email_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="phone" class="fw-bold">Phone Number</label>
                            <input type="text"  value="{{Auth::user()->phone}}"  name="phone" class=" form-control phone border border-secondry border-2 ps-2" placeholder="Enter tour phone">
                            <span id="phone_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="adress1" class="fw-bold">Adress 1</label>
                            <input type="text"  value="{{Auth::user()->adress1}}"  name="adress1" class=" form-control adress1 border border-secondry border-2 ps-2" placeholder="Enter Adress 1">
                            <span id="adress1_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="adress2" class="fw-bold">Adress 2</label>
                        <input type="text"  value="{{Auth::user()->adress2}}"  name="adress2" class=" form-control adress2 border border-secondry border-2 ps-2" placeholder="Enter Adress 2">
                        <span id="adress2_error" class="text-danger"></span>
                       </div>
                       
                        <div class="col-md-6">
                            <label for="city" class="fw-bold">City</label>
                            <input type="text"  value="{{Auth::user()->city}}"  name="city" class="form-control city border border-secondry border-2 ps-2" placeholder="Enter your city">
                            <span id="city_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="State" class="fw-bold">State</label>
                            <input type="text"  value="{{Auth::user()->state}}"  name="state" class=" form-control state border border-secondry border-2 ps-2" placeholder="Enter your state">
                            <span id="state_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="country" class="fw-bold">Country</label>
                            <input type="text"  value="{{Auth::user()->country}}"  name="country" class=" form-control country border border-secondry border-2 ps-2" placeholder="Enter your country">
                            <span id="country_error" class="text-danger"></span>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="pincode" class="fw-bold">Pin Code</label>
                            <input type="text"  value="{{Auth::user()->pincode}}"  name="pincode" class=" form-control pincode border border-secondry border-2 ps-2" placeholder="Enter your Pin code">
                            <span id="pincode_error" class="text-danger"></span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                   <h6>Order Details</h6>
                   <hr class="bg-secondary">
                   @if($cartItems->count()>0)
                   <table class="table table-striped">
                     <thead>
                        <tr>
                            <th class="ps-0">Name</th>
                            <th class="ps-0">Quantity</th>
                            <th class="ps-0">Price</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>{{$item->products->name}}</td>
                            <td>{{$item->product_qty}}</td>
                            <td>{{$item->products->selling_price}}</td>
                        </tr>
                        @endforeach
                     </tbody>

                   </table>
                   <hr class="bg-secondary">
                   <input type="hidden" name="payment_mode" value="COD">
                   <button type="submit" class="btn btn-success float-end">Place order | COD</button>
                   <button type="button" class="btn btn-primary razorpay_btn">Pay With Razorpay</button>
                    <div id="paypal-button-container"></div>
                   @else
                   <h3 class="text-center">No products in cart</h3>
                </div>
                @endif
               
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ASkKsX9LkOz6lKNZ76YGH2e6TzV29dqM03yJMFZ9RvISMrdyrnDZwE_7G1TwoTDDf4dXfyXX_PTbXyFt"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
      paypal.Buttons({
        // Order is created on the server and the order id is returned
        createOrder() {
          return fetch("/my-server/create-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product skus and quantities
            body: JSON.stringify({
              cart: [
                {
                  sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                  quantity: "YOUR_PRODUCT_QUANTITY",
                },
              ],
            }),
          })
          .then((response) => response.json())
          .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
          return fetch("/my-server/capture-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          })
          .then((response) => response.json())
          .then((orderData) => {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  window.location.href = 'thank_you.html';
          });
        }
      }).render('#paypal-button-container');
    </script>
         
        
      
    

  </script>

@endsection