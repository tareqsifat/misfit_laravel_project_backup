<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Stygen online shop bkash payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom Style -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/blog_style.css') }}">
    <style>
        .bkash_btn {
            background: #5e2e87 none repeat scroll 0 0;
            margin: 0px 0 10px !important;
            border: medium none;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
            height: 50px;
            margin: 20px 0 0;
            padding: 0;
            text-transform: uppercase;
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            width: 100%;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .vertical-center {
            min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh; /* These two lines are counted as one :-)       */

            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="vertical-center">
        <div class="container">
            <div id="ui-view" data-select2-id="ui-view">
                <div>
                    <div class="d-flex justify-content-end my-3">
                        <a href="/cart" class="btn btn-secondary btn-sm">Go back</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Invoice no:
                            <b class="invoice" id="invoice">{{ $invoice }}</b>
                        </div>
                        <div class="card-body">

                            <h3 class="text-center my-5">Your order</h3>

                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th class="center">Quantity</th>
                                            <th class="right">Unit Cost</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td class="center">{{ $key+1 }}</td>
                                                <td class="left">{{ $product['name'] }}</td>
                                                <td class="center">{{ $product['quantity'] }}</td>
                                                <td class="right">৳{{ $product['price'] }}</td>
                                                <td class="right">৳{{ $product['quantity'] * $product['price'] }}</td>
                                            </tr>
                                            {{-- <tr class="cart_item">
                                                <td class="cart-product-name"> {{ $product['name'] }}<strong class="product-quantity"> × {{ $product['quantity'] }}</strong></td>
                                                <td class="cart-product-total"><span>৳{{ $product['quantity'] * $product['price'] }}</span></td>
                                            </tr> --}}
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5"></div>
                                <div class="col-lg-4 col-sm-5 ml-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left">
                                                    <strong>Subtotal</strong>
                                                </td>
                                                <td class="right">৳{{ $cart_total }}</td>
                                            </tr>

                                            <tr>
                                                <td class="left">
                                                    <strong>Shipping Charge</strong>
                                                </td>
                                                <td class="right">৳{{ $shipping_cost }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="right">
                                                    <strong>৳<span class="amount" id="amount">{{ $total }}</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <button id="bKash_button" class="bkash_btn">Pay with bkash</button>
                                    </div>
                                    {{-- <a class="btn btn-success" href="#" data-abc="true"> <i class="fa fa-usd"></i> Pay with bkash</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js" integrity="sha256-7Aj3hR8VjszIO1+v+ehR706sD5wpug0foOso7pqP4OY=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script id = "myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
{{-- <script id = "myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script> --}}
<script>
    // window.onload = function () {
    //     document.getElementById("bKash_button").click();
    // };
    window.Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
</script>

<script>
    var price = $('.amount').text();
    console.log(price);
    var paymentID = '';
    bKash.init({
      paymentMode: 'checkout', //fixed value ‘checkout’
      //paymentRequest format: {amount: AMOUNT, intent: INTENT}
      //intent options
      //1) ‘sale’ – immediate transaction (2 API calls)
      //2) ‘authorization’ – deferred transaction (3 API calls)
      paymentRequest: {
        amount: price, //max two decimal points allowed
        intent: 'sale'
      },
      createRequest: function(request) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
       console.log("create working !!")
        $.ajax({
          url: 'createpayment',
          type: 'POST',
          data: JSON.stringify(request),
          contentType: 'application/json',
          success: function(data) {

            if (data && data.paymentID != null) {
              paymentID = data.paymentID;
              bKash.create().onSuccess(data); //pass the whole response data in bKash.create().onSucess() method as a parameter
            } else {
              bKash.create().onError();
            }
          },
          error: function() {
            bKash.create().onError();
          }
        });
      },
      executeRequestOnAuthorization: function() {
        console.log("execute working !!")
        $.ajax({
          url: 'executepayment',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            "paymentID": paymentID
          }),
          success: function(data) {

           console.log("execute response " , data)
            data = JSON.parse(data);
            if (data && data.paymentID != null) {
              console.log("trxID: ",data.trxID)
              window.location.href = "/thank-you"; // Your redirect route when successful payment
            } else {
                console.log("error ");

                window.location.href = "/failed"; // Your redirect route when fail payment
                bKash.execute().onError();
            }
          },
          error: function() {
            bKash.execute().onError();
          }
        });
      },
      onClose: function(){
        window.location.href='/cart';  // Your redirect route when cancel payment
      },
    });
</script>
</html>
