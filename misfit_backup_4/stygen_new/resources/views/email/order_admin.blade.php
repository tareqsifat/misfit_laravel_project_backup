<html lang="en">
<head>
    <title>Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /*-------------------------------Total Html Style--------------------------------*/
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /*---Total Html Style---*/
        html, body {
            width: 70%;
            margin: 0;
            padding: 0;
            margin-left: auto;
            margin-right: auto;
            float: none;
            overflow: hidden;
        }

        /*---Mobile View Html Style---*/
        @media only screen and (max-width: 768px) {
            html, body {
                width: auto !important;
                margin: 0;
                padding: 0;
                margin-left: auto;
                margin-right: auto;
                float: none;
                overflow: hidden;
            }
        }
        h3 {
            font-family: 'Segoe UI',sans-serif,Arial,Helvetica,Lato;
            font-size: 16px;
            line-height: 24px;
        }
        p {
            font-family: 'Segoe UI',sans-serif,Arial,Helvetica,Lato;
            font-size: 14px;
            line-height: 12px;
        }

        /*-------------------------------Clear floats after the columns---------------------*/
        section:after {
            content: "";
            display: table;
            clear: both;
        }

        /*------------------------------------Header Css------------------------------------*/
        header {
            background-color: #85a5b8;
            padding: 17px;
            text-align: center;
            color: white;
        }
        /*---Header Section Container Css---*/
        .container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        /*---Header Container Section Left Div Css---*/
        .left {
            width: 20%;
        }
        /*---Header Container Section Center Div Css---*/
        .center {
            width: 45%;
            padding-top: 17px;
        }
        /*---Header Container Section Right Div Css---*/
        .right {
            width: 25%;
            padding-top: 17px;
        }
        /*-------------------------------------Article Css---------------------------------*/
        article {
            float: left;
            padding: 0 30px;
            width: 100%;
            background-color: #f5f5f5;
            height: auto;
        }

        /*-------------------------------------Footer Css-----------------------------------*/
        footer {
            background-color: #cccccc;
            padding: 10px;
            text-align: center;
            color: white;
        }
        /*---Footer Left Div Css---*/
        .footerleft{
            width: 100%;
        }
        /*---Footer Center Div Css---*/
        .footercenter{
            width: 50%;
        }
        /*---Footer Right Div Css---*/
        .footerright{
            width: 50%;
            padding-top: 17px;
        }

        .footerright img {
            margin-left: 5px !important;
        }

        /*--------------------------------Table Section Css---------------------------------*/
        th {
            color: #636363;
            border: 1px solid #e5e5e5;
            vertical-align: middle;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        td {
            color: #636363;
            border: 1px solid #e5e5e5;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
            font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;
            word-wrap: break-word;
            font-size: 14px;
        }

    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="left">
            <img src="{{ asset('assets/frontend/img/logo/logo.png') }}" style="width: 70px;">
        </div>
    </div>
</header>
<section>
    <article>
        <p>Hello Admin,</p>
        <p>New order from {{ $info['name'] }}.</p>
        <p><b>OrderID :</b> {{ $info['orderId'] }}</p>
        <p><b>Phone :</b> {{ $info['phone'] }}</p>

        @if(isset($info['email']))
            <p><b>Email :</b> {{ $info['email'] }}</p>
        @endif

        <table cellspacing="0" cellpadding="6" border="1" style="margin-top: 15px; margin-bottom: 15px; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
            <thead>
            <tr>
                <th scope="col">SI</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Total Amount</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach($orderdetails as $key => $order_detail)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order_detail->product_name }}</td>
                        <td>{{ $order_detail->price }}</td>
                        <td>{{ $order_detail->quantity }}</td>
                        <td><span><span>৳&nbsp;</span>{{ $order_detail->total_amount }}</span></td>
                    </tr>
                    @php
                        $subTotal += $order_detail->quantity * $order_detail->price;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                @if(isset($subTotal))
                    <tr>
                        <th scope="row" colspan="4">Sub Total:</th>
                        <td><span><span>৳&nbsp;</span>{{ $subTotal }}</span></td>
                    </tr>
                @endif

                {{-- @if(isset($info['total_vat']))
                    <tr>
                        <th scope="row" colspan="4">Total Vat:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['total_vat'] }}</span></td>
                    </tr>
                @endif --}}

                @if(isset($info['shipping_charge']))
                    <tr>
                        <th scope="row" colspan="4">Shipping Charge:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['shipping_charge'] }}</span></td>
                    </tr>
                @endif

                @if(isset($info['card_price']))
                    <tr>
                        <th scope="row" colspan="4">Greetings Card:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['card_price'] }}</span></td>
                    </tr>
                @endif

                @if(isset($info['packaging_price']))
                    <tr>
                        <th scope="row" colspan="4">Packaging:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['packaging_price'] }}</span></td>
                    </tr>
                @endif



                @if(isset($info['discount_amount']))
                    <tr>
                        <th scope="row" colspan="4">Discount Amount:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['discount_amount'] }}</span></td>
                    </tr>
                @endif

                @if(isset($info['net_receivable']))
                    <tr>
                        <th scope="row" colspan="4">Net Total Amount:</th>
                        <td><span><span>৳&nbsp;</span>{{ $info['net_receivable'] }}</span></td>
                    </tr>
                @endif
            </tfoot>
        </table>
    </article>
</section>
</body>
</html>
