<html>
<title>Order Invoice</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        @font-face {
            font-family: 'Siyam Rupali';
            src: url('http://localhost/sme-vai-updated/fonts/Siyamrupali.ttf') format('truetype')
        }

        body{
            font-family: "Siyam Rupali",Cambria,sans-serif;
        }
        /*Start First Section*/
        .first-section .column.f1 {
            float: left !important;
            /* width: 60% !important; */
            padding: 0px !important;
            font-size: 12px !important;
            line-height: 5px !important;
        }
        .first-section .column.f2 {
            float: left !important;
            /* width: 40% !important; */
            padding: 0px !important;
            font-size: 12px !important;
            line-height: 5px !important;
        }
        .company-logo{
            width: 86px !important;
            height: 38px !important;
        }
        /*End First Section*/

        /*Start Second Section*/
        .second-section .column.invoice-name{
            width: 10% !important;
            text-align: left !important;
        }
        /*End Second Section*/

        /*Start Third Section*/
        .third-section .column {
            padding: 0px !important;
            font-size: 12px !important;
            line-height: 5px !important;
        }
        .third-section .column.sec1{
            float: left !important;
            /* width: 60% !important; */
        }
        .third-section .column.sec2{
            float: left !important;
            /* width: 30% !important; */
        }
        .third-section .column.sec3{
            float: left !important;
            /* width: 40% !important; */
        }

        .subject-section {
            width: 100%;
            margin-top: 55px;
            font-size: 16px;
        }

        .subject-section table {
            border: none;
        }

        .subject-section .subject-table tr th{
            border: 0px!important;
            margin-left: 0px;
            font-size: 16px!important;
            font-weight: 100;
            padding: 0px !important;
        }

        .sec3 .invoice-details1{ margin-left: 12px !important; }
        .sec3 .invoice-details2{ margin-left: 28px !important; }
        .sec3 .invoice-details3{ margin-left: 19px !important; }
        .sec3 .invoice-details4{ margin-left: 35px !important; }
        .sec3 .invoice-details5{ margin-left: 7px !important; }
        .sec3 .invoice-details6{ margin-left: 13px !important; }
        /*End Third Section*/

        /*Start Fourth Section*/
        .fourth-section table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px !important;
        }

        .fourth-section table .product-name{
            width: 20% !important;
        }
        .fourth-section table .product-sku{
            width: 10% !important;
        }
        .fourth-section table .product-attributes{
            width: 15% !important;
        }
        .fourth-section table .product-qty{
            width: 10% !important;
            text-align: center !important;
        }
        .fourth-section table .bonus-qty{
            width: 10% !important;
            text-align: center !important;
        }
        .fourth-section table .sales-price{
            width: 15% !important;
        }
        .fourth-section table .total-price{
            width: 20% !important;
            text-align: right !important;
        }

        .fourth-section .column table td, th {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 12px !important;
            padding: 4px !important;
        }
        .calculation-section .column.col1{ float: left !important; width: 48% !important; font-size: 14px !important; }
        .calculation-section .column.col2{ float: left !important; width: 33% !important; font-size: 14px !important; }
        .calculation-section .column.col3{ float: left !important; width: 19% !important; font-size: 14px !important; }

        .calculation-section .custom-hr1{ margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr2{ border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr3{ border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr4{ border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr5{ margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr6{ margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr7{ border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top: 10px !important; margin-bottom: 0 !important; }
        .calculation-section .custom-hr8{ border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top: 10px !important; margin-bottom: 0 !important; }

        .calculation-section .total{ margin-top: 10px !important; margin-bottom: -8px !important; font-weight: normal !important; }
        .calculation-section .discount{ margin-top: 0 !important; margin-bottom: -8px !important; font-weight: normal !important; }
        .calculation-section .netReceivable{ margin-top: 0 !important; margin-bottom: -8px !important; font-weight: normal !important; }
        .calculation-section .paidAmount{ margin-top: 0 !important; margin-bottom: -8px !important; font-weight: normal !important; }
        .calculation-section .dueAmount{ margin-top: 5px !important; margin-bottom: -5px !important; font-weight: normal !important; }
        .calculation-section .vatTax{ margin-top: 0 !important; margin-bottom: -8px !important; font-weight: normal !important; }
        .calculation-section .shippingCharge{ margin-top: 0 !important; margin-bottom: -8px !important; font-weight: normal !important; }

        .calculation-section .totalVal{ margin-top: 10px !important; margin-bottom: -8px !important; text-align: right !important; }
        .calculation-section .discountVal{ margin-top: 0px !important; margin-bottom: -8px !important; text-align: right !important; }
        .calculation-section .netReceivableVal{ margin-top: 0px !important; margin-bottom: -8px !important; text-align: right !important; }
        .calculation-section .paidAmountVal{ margin-top: 0px !important; margin-bottom: -8px !important; text-align: right !important; }
        .calculation-section .dueAmountVal{ margin-top: 5px !important; margin-bottom: -5px !important; text-align: right !important; }
        .calculation-section .vatTaxVal{ margin-top: 0 !important; margin-bottom: -8px !important; text-align: right !important; }
        .calculation-section .shippingChargeVal{ margin-top: 0 !important; margin-bottom: -8px !important; text-align: right !important; }
        /*End Fourth Section*/
        .footer .footer-text {
            width: 100%;
            text-align: center !important;
            position: fixed !important;
            bottom: 0;
        }
        .signTitle {
            position: fixed;
            bottom: 30;
            width: 100%;
            text-align: center;
            height: 50px;
        }
        .line{
            position: relative;
            font-size: 12px !important;
        }

        .line::after{
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translate(-50%, 0%);
            display: block;
            width: 150px;
            height: 1px;
            background: #000;
        }
        .signature{
            width: 100% !important;
        }
        .signature td{
            width: 32% !important;
            text-align: center !important;
        }
        .fontSize{
            font-size: 12px !important;
        }
        .invoice_address{
            line-height: 15px !important;
        }
    </style>
</head>
<body>
<!--Start First Section-->
<div class="row first-section">
    <div class="column f1" style="@if($order->ship_to_gift == 1) width: 66% !important @else width: 60% !important @endif">
        {{-- @if(!empty($companyInfo->image))
            <img class="company-logo" src="{{ asset('assets/uploads/seller/'.$companyInfo->image) }}" alt="" style="width:100px !important; height:auto !important;">
        @else
            <img class="company-logo" src="{{ asset('assets/uploads/seller/company-avatar.jpg') }}" alt="" style="width:100px !important; height:100px !important;">
        @endif --}}
        <img class="company-logo" src="{{ asset('assets/frontend/img/logo/logo.png') }}" alt="" style="width:100px !important; height:auto !important;">
    </div>
    <div class="column f2" style="@if($order->ship_to_gift == 1) width: 34% !important @else width: 40% !important @endif">
        <h4 class="fontSize">
            STYGEN
        </h4>
        <p class="fontSize">+880 1971 971 520</p>
        <p class="fontSize">info@stygen.gift</p>
        <p class="fontSize">House: 65, Level-2, Road: 03, Block: B, </p>
        <p class="fontSize">Niketon, Gulshan-1,  Dhaka</p>
        {{-- <h4 class="fontSize">
            @if(isset($companyInfo))
                {{ $companyInfo->name }}
            @endif
        </h4> --}}
        <?php
        //$address = $companyInfo->address;
        //$length = strlen($address);
        //$final_address = substr($address, 0, 48);
        //$final_address1 = substr($address, 48, $length);

        //$array = str_split($address, 40);

        ?>
        {{-- <p class="fontSize" style="line-height:15px !important; padding-top:-14px !important;"><?php //echo implode("<br>",$array); ?></p> --}}
    </div>
</div>
<!--End First Section-->

<!--Start Second Section-->
<div class="row second-section">
    <div class="column invoice-name">
        <h2>INVOICE</h2>
    </div>
</div>
<!--End Second Section-->

<!--Start Third Section-->
<div class="row third-section">
    <div class="column sec1" style="@if($order->ship_to_gift == 1) width: 33% !important @else width: 60% !important @endif">
        @if(isset($order->customer))
            <p class="fontSize">{{ $order->customer['customer_name'] }}</p>
            <p class="fontSize invoice_address">{{ $order->customer['customer_address'] }}</p>
            <p class="fontSize">{{ $order->customer['customer_phone'] }}</p>
            <p class="fontSize">{{ $order->customer['customer_email'] }}</p>
        @endif
    </div>

    @if($order->ship_to_gift == 1)
        <div class="column sec2" style="width: 33% !important">
            @if(isset($order->shipping))
                <h5>Shipping Details:</h5>
                <p class="fontSize">{{ $order->shipping['shipping_name'] }}</p>
                <p class="fontSize invoice_address">{{ $order->shipping['shipping_address'] }}</p>
                <p class="fontSize">{{ $order->shipping['shipping_phone'] }}</p>
                <p class="fontSize">{{ $order->shipping['shipping_email'] }}</p>
            @endif
        </div>
    @endif

    <div class="column sec3" style="margin-top: 30px !important; @if($order->ship_to_gift == 1) width: 33% !important; @else width: 40% !important; @endif">
        <p class="fontSize">Invoice No : <span class="invoice-details1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# {{ $order->invoice_no }}</span></p>
        <p class="fontSize">Invoice Date: <span class="invoice-details2">&nbsp;{{ DateTime::createFromFormat('Y-m-d', $order->invoice_date)->format('F d, Y') }}</span></p>
        <p class="fontSize">Order Date: <span class="invoice-details4">&nbsp;{{ DateTime::createFromFormat('Y-m-d', $order->invoice_date)->format('F d, Y') }}</span></p>
        @if($order->payment_type == 1)
            <p class="fontSize">Payment Method: <span class="invoice-details5">Cash on Delivery</span></p>
        @else
            <p class="fontSize">Payment Method: <span class="invoice-details5">Online Payment</span></p>
        @endif
    </div>
</div>
<!--End Third Section-->

<!--Start Fourth Section-->
<div class="row fourth-section" style="padding-top: 13% !important;">
    <div class="column">
        <table>
            <tr>
                <th class="product-name"> Product</th>
                <th class="product-sku"> SKU</th>
                <th class="product-attributes">Attributes</th>
                <th class="product-qty">Quantity</th>
                <th class="sales-price">Price</th>
                <th class="total-price">Total</th>
            </tr>
            @php
                $subTotal = 0;
            @endphp
            @foreach($order_details as $order_detail)
                <tr>
                    <td class="product-name">{{ $order_detail->product['product_name'] }}</td>
                    <td class="product-sku">{{ $order_detail->product['product_sku'] }}</td>
                    <td>
                        @if($order->order_attributes)
                            @foreach ($order->order_attributes as $attribute)
                                @if ($attribute->product_id == $order_detail->product['id'])
                                    @if($attribute->color)<span><b>Color:</b> {{ $attribute->color }}</span>@endif
                                    @if($attribute->size)<span>, <b>Size:</b> {{ $attribute->size }}</span>@endif
                                    @if($attribute->weight)<span>, <b>Weight:</b> {{ $attribute->weight }}</span>@endif
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="product-qty">{{number_format($order_detail->quantity, 0)}}</td>
                    <td class="sales-price">{{number_format($order_detail->price, 2)}}</td>
                    <td class="total-price">{{number_format($order_detail->total_amount, 2)}}</td>
                </tr>
                @php
                    $subTotal += $order_detail->quantity * $order_detail->price;
                @endphp
            @endforeach
        </table>
        <div class="row calculation-section" style="padding-top:1% !important;">
            <div class="column col1"></div>
            <div class="column col2">
                <p class="total fontSize"><b>Sub Total:</b></p>
                <hr class="custom-hr2">
                <p class="vatTax fontSize"><b>Vat & Tax:</b></p>
                <hr class="custom-hr7">
                <p class="shippingCharge fontSize"><b>Shipping Charge:</b></p>
                <hr class="custom-hr8">
                <p class="discount fontSize"><b>Discount:</b></p>
                <hr class="custom-hr2">
                <p class="discount fontSize"><b>Greetings Card:</b></p>
                <hr class="custom-hr7">
                <p class="discount fontSize"><b>Packaging:</b></p>
                <hr class="custom-hr3">
                <p class="netReceivable fontSize"><b>Total:</b></p>
                <hr class="custom-hr4">
                <hr class="custom-hr1">
            </div>
            <div class="column col3">
                @if(isset($subTotal))
                    <p class="totalVal fontSize"> {{number_format($subTotal, 2)}}</p>
                @else
                    <p class="totalVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr7">
                @if(isset($order->total_vat))
                    <p class="vatTaxVal fontSize"> {{number_format($order->total_vat, 2)}} </p>
                @else
                    <p class="vatTaxVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr8">
                @if(isset($order->shipping_charge))
                    <p class="shippingChargeVal fontSize"> {{number_format($order->shipping_charge, 2)}} </p>
                @else
                    <p class="shippingChargeVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr2">
                @if(isset($order->discount_amount))
                    <p class="discountVal fontSize"> {{number_format($order->discount_amount, 2)}} </p>
                @else
                    <p class="discountVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr8">
                @if(isset($order->card_price))
                    <p class="discountVal fontSize"> {{number_format($order->card_price, 2)}} </p>
                @else
                    <p class="discountVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr7">
                @if(isset($order->packaging_price))
                    <p class="discountVal fontSize"> {{number_format($order->packaging_price, 2)}} </p>
                @else
                    <p class="discountVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr3">
                @if(isset($order->net_receiveable_amount))
                    <p class="netReceivableVal fontSize"> {{number_format($order->net_receiveable_amount, 2)}} </p>
                @else
                    <p class="netReceivableVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr4">
                <hr class="custom-hr1">
            </div>
        </div>
    </div>
</div>
<!--End Fourth Section-->

<!--Start Footer Section-->
<div class="signTitle">
    <table class="table signature" border="0">
        <tr>
            <td><span class="line fontSize">Prepared by</span></td>
            <td><span class="line fontSize">Authorized by</span></td>
            <td><span class="line fontSize">Received by</span></td>
        </tr>
    </table>
</div>
<div class="footer">
    <p class="footer-text">Powered by STYGEN</p>
</div>
<!--End Footer Section-->
</body>
</html>
