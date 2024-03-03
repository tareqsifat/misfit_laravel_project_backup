<html>
<title>Order Invoice</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>

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
            width: 30% !important;
        }
        .fourth-section table .product-sku{
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



    /*    * {
  box-sizing: border-box;
  }*/

  /* Create three equal columns that floats next to each other */
  .columnNew {
      float: left;
      width: 33.33%;
      /*padding: 10px;*/
      line-height: 1px;
  }

  /* Clear floats after the columns */
  .rowNew:after {
      content: "";
      display: table;
      clear: both;
  }
</style>
</head>
<body>
    <div class="rowNew">
      <div class="columnNew">
        <div class="column f1">
        <img class="company-logo" src="{{ asset('assets/frontend/img/logo/logo.png') }}" style="width: 200px;">
    </div>
        <div style="margin-top: 10px;">
            <h2>INVOICE</h2>
        </div>
    </div>
    <div class="columnNew">

   </div>
   <div class="columnNew">
        <h4>
            STYGEN
        </h4>
        <p class="fontSize">+880 1971 971 520</p>
        <p class="fontSize">info@stygen.gift</p>
        <p class="fontSize">House: 65, Level-2, Road: 03, Block: B, </p>
        <p class="fontSize">Niketon, Gulshan-1,  Dhaka</p>
</div>
</div>


<!--Start Third Section-->
<div class="rowNew">
  <div class="columnNew">
    @if(isset($customerInfo))
    <p><b>Customer Info</b></p>
    <p class="fontSize">{{ $customerInfo->customer_name }}</p>
    <p class="fontSize">{{ $customerInfo->customer_phone }}</p>
    @if(isset($customerInfo->customer_email))
    <p class="fontSize">{{ $customerInfo->customer_email }}</p>
    @endif
    <p class="fontSize">{{ $customerInfo->customer_address }}</p>
    @endif
</div>
<div class="columnNew">
   @if(isset($shippingInfo))
   <p><b>Shipping To</b></p>
   <p class="fontSize">{{ $shippingInfo->shipping_name }}</p>
   <p class="fontSize">{{ $shippingInfo->shipping_phone }}</p>
   @if($shippingInfo->shipping_email)
   <p class="fontSize">{{ $shippingInfo->shipping_email }}</p>
   @endif
   <p class="fontSize">{{ $shippingInfo->shipping_address }}</p>
   @endif
</div>
<div class="columnNew">
    <p><b>Invoice Info</b></p>
    <p class="fontSize">Invoice Number: <span class="invoice-details1"># {{ $order->invoice_no }}</span></p>
    <p class="fontSize">Invoice Date: <span class="invoice-details2">{{ DateTime::createFromFormat('Y-m-d', $order->invoice_date)->format('F d, Y') }}</span></p>
    <p class="fontSize">Order Date: <span class="invoice-details4">{{ DateTime::createFromFormat('Y-m-d', $order->invoice_date)->format('F d, Y') }}</span></p>
    <p class="fontSize">Order Number: <span class="invoice-details3"># {{ $order->orderId }}</span></p>
    @if($order->payment_type == 1)
    <p class="fontSize">Payment Method: <span class="invoice-details5">Cash on Delivery</span></p>
    @else
    <p class="fontSize">Payment Method: <span class="invoice-details5">Online Payment</span></p>
    @endif
</div>
</div>
<!--End Third Section-->

<br>

<!--Start Fourth Section-->
<div class="row fourth-section">
    <div class="column">
        <table>
            <tr>
                <th class="product-name"> Product</th>
                <th class="product-sku"> SKU</th>
                <th class="product-qty">Quantity</th>
                <th class="sales-price">Price</th>
                <th class="total-price">Total</th>
            </tr>
            @foreach($order_details as $order_detail)
            <tr>
                <td class="product-name">{{ $order_detail->product_name }}</td>
                <td class="product-sku">{{ $order_detail->product_sku }}</td>
                <td class="product-qty">{{number_format($order_detail->quantity, 0)}}</td>
                <td class="sales-price">{{number_format($order_detail->price, 2)}}</td>
                <td class="total-price">{{number_format($order_detail->total_amount, 2)}}</td>
            </tr>
            @endforeach
        </table>
        <div class="row calculation-section">
            <div class="column col1"></div>
            <div class="column col2">
                <p class="total fontSize"><b>Sub Total:</b></p>
                <hr class="custom-hr2">
                {{-- <p class="vatTax fontSize"><b>Vat:</b></p>
                <hr class="custom-hr7"> --}}
                <p class="shippingCharge fontSize"><b>Shipping Charge:</b></p>
                <hr class="custom-hr8">
                <p class="discount fontSize"><b>Discount:</b></p>
                <hr class="custom-hr3">
                <p class="netReceivable fontSize"><b>Total:</b></p>
                <hr class="custom-hr4">
                <hr class="custom-hr1">
            </div>
            <div class="column col3">
                @if(isset($order->total_amount))
                <p class="totalVal fontSize"> {{ $order->total_amount }}</p>
                @else
                <p class="totalVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr7">
                {{-- @if(isset($order->total_vat))
                <p class="vatTaxVal fontSize"> {{number_format($order->total_vat, 2)}} </p>
                @else
                <p class="vatTaxVal fontSize"> 0</p>
                @endif
                <hr class="custom-hr8"> --}}
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
