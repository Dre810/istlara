<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    

    <div class="container">
        <div class="header mt-2 px-5 text-center bg-primary py-5 text-white">
            <h3>Pay for Services</h3>
          
        </div>
        <div class="main">
            
    <form id="makePaymentForm">
        @csrf
     <div class="row">
        <div class="col-6">
             <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter full name">
             </div>
        </div>
         <div class="col-6">
             <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email address">
             </div>
         </div>
        <div class="col-6">
            <label for="amount">Amount</label>
            <input type="number" name="amount" placeholder="Enter amount" id="amount" class="form-control" >
        </div>
         <div class="col-6">
            <label for="phone">Phone Number</label>
            <input type="number" name="number" placeholder="Enter number" id="number" class="form-control" >
        </div>
     </div>
      <div class="form-group mt-2">
          <button type="submit" class="btn btn-primary"> Pay Now </button>
      </div>
    </form>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>


    <script>

    $(function () {
        $("#makePaymentForm").submit(function (e) {
            e.preventDefault();
            var name = $("#name").val();
            var email = $("#email").val();
            var phone = $("#number").val();
            var amount = $("#amount").val();
            //make our payment
            makePayment(amount,email,phone,name);
    
            
        });
    });

        function makePayment(amount,email,phone_number,name) {
            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-c00b1d7a00353423a575ef61dfc47442-X",
                tx_ref: "RX1_{{substr(rand(0,time()),0,7)}}",
                amount,
                currency: "USD",
                payment_options: "",
               
                customer: {
                    email,
                    phone_number,
                    name,
                },
                callback: function (data) {
                    var transaction_id = data.transaction_id;
                  // make ajax reuest
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                    type:"POST",
                    url:"{{URL::to('verify-payment')}}",
                    data:{
                        transaction_id,
                        _token
                    },
                   
                    success:function(response){
                        console.log(response);
                        
                        
                    }
                  });

            
                },
                onclose: function () {
                    // close modal
                },
                customizations: {
                    title: "My store",
                    description: "Payment for items in cart",
                    logo: "https://th.bing.com/th/id/OIP.vjheN7hccEcuk3QSbWkHuAHaE7?w=211&h=180&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3",
                },
            });
             
        }
    </script>
  </body>
</html>