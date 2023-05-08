$(document).ready(function(){
    $('.razorpay_btn').click(function(e){
        e.preventDefault();
         var firstname = $('.firstname').val();
         var lastname = $('.lastname').val();
         var email = $('.email').val();
         var phone =  $('.phone').val();
         var adress1 =  $('.adress1').val();
         var adress2 =  $('.adress2').val();
         var city  =  $('.city').val();
         var state = $('.state').val();
         var country =  $('.country').val();
         var pincode =  $('.pincode').val();
        if(!firstname){
            fname_error = "First name is required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }else{
            fname_error = "";
            $('#fname_error').html('');
        }
        if(!lastname){
            lname_error = "Last name is required";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        }else{
            lname_error = "";
            $('#lname_error').html('');
        }
        if(!email){
            email_error = "Email is required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }else{
            email_error = "";
            $('#email_error').html('');
        }
        if(!phone){
            phone_error = "Phone is required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }else{
            phone_error = "";
            $('#phone_error').html('');
        }
        if(!adress1){
            adress1_error = "Adress1 is required";
            $('#adress1_error').html('');
            $('#adress1_error').html(adress1_error);
        }else{
            adress1_error = "";
            $('#adress1_error').html('');
        }
        if(!adress2){
            adress2_error = "Adress2 is required";
            $('#adress2_error').html('');
            $('#adress2_error').html(adress2_error);
        }else{
            adress2_error = "";
            $('#adress2_error').html('');
        }
        if(!city){
            city_error = "City is required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }else{
            city_error = "";
            $('#city_error').html('');
        }
        if(!country){
            country_error = "Country is required";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        }else{
            country_error = "";
            $('#country_error').html('');
        }
        if(!state){
            state_error = "State is required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        }else{
            state_error = "";
            $('#state_error').html('');
        }
        if(!pincode){
            pincode_error = "Pincode is required";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }else{
            pincode_error = "";
            $('#pincode_error').html('');
        }
        if(fname_error != '' || lname_error != '' || email_error != '' || phone_error != '' || adress1_error != ''
         || adress2_error != '' || city_error != '' || country_error != '' || state_error != '' || pincode_error != ''){
            return false;
         }else{
            var data ={
                'firstname':firstname,
                'lastname':lastname,
                'email':email,
                'phone':phone,
                'adress1':adress1,
                'adress2':adress2,
                'city':city,
                'country':country,
                'state':state,
                'state':state,
                'pincode':pincode
            }
            $.ajax({
                method:"POST",
                url:"/procced-to-pay",
                data:data,
                success:function(response){
                    var options = {
                        "key": "rzp_test_bnG8DXpT7N2JQE", // Enter the Key ID generated from the Dashboard
                        "amount": 1*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": response.firstname+' '+response.lastname, //your business name
                        "description": "Thank you for choosing us",
                        "image": "https://example.com/your_logo",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
                            // alert(responsea.razorpay_payment_id);
                            $.ajax({
                                method:"post",
                                url:"/place-order",
                                data:{
                                    'fname':response.firstname,
                                    'lname':response.lastname,
                                    'email':response.email,
                                    'phone':response.phone,
                                    'adress1':response.adress1,
                                    'adress2':response.adress2,
                                    'city':response.city,
                                    'country':response.country,
                                    'state':response.state,
                                    'pincode':response.pincode,
                                    'payment_mode':"paid by Razorpay",
                                    'payment_id':responsea.razorpay_payment_id,

                                },
                                
                                success:function(responseb){
                                //  alert(responseb.message);
                                swal(responseb.message);
                                window.location.href ='/my-orders';
                                }
                        });
                        },
                        "prefill": {
                            "name": response.firstname+' '+response.lastname, //your customer's name
                            "email":response.email,
                            "contact":response.phone
                        },
                       
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                   
                    
                        rzp1.open();
                        e.preventDefault();
                 
                }
               });

         }
    })
})