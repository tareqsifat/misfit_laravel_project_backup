<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\CartManagerController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Helper;
use DateTime;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Seller;
use App\Models\Shipping;
use App\Models\ProductStock;
use App\Models\ShippingCharge;
use App\Models\StockLedger;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SslCommerzPaymentController extends Controller
{
    private $cart_handler;
    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $this->cart_handler = new CartManagerController();
        $request->validate([
            'name' => 'required|max:100',
            'address' => 'required|max:200',
            'email' => 'nullable|email',
            'phone' => 'required',
            'shipping_charge_id' => ['required','exists:shipping_charges,id'],
        ]);
        // cart data's
        $coupon_code            = $request->coupon_code;
        $coupon_amount          = $request->coupon_amount;
        // if()

        $paymentType            = $request->cashOnDelivery;
        $createAccountStatus    = $request->createAccount;
        // $carts                  = \Cart::getContent();
        $carts                  = $this->cart_handler->get();

        // $cart_count             = count($carts);
        $cart_count             = $this->cart_handler->cart_count();
        $current_date           = date('d/m/Y');
        $invoice_date           = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');
        // $cart_total_amount      = \Cart::getTotal();
        $cart_total_amount      = floatval($this->cart_handler->cart_total());
        // dd($carts);
        $card_id                = (!empty($request->card_id)?$request->card_id:NULL);
        $card_price             = (!empty($request->card_price)?$request->card_price:0);
        $packaging_id           = (!empty($request->packaging_id)?$request->packaging_id:NULL);
        $packaging_price        = (!empty($request->packaging_price)?$request->packaging_price:0);
        $personal_notes         = (!empty($request->personal_notes)?$request->personal_notes:NULL);
        $get_shipping_charge    = ShippingCharge::where('id', $request->shipping_charge_id)->first();
        // dd($get_shipping_charge);
        if($get_shipping_charge) {
            $shipping_charge = $get_shipping_charge->shipping_charge;
        } else {
        // Shipping charge not found
        $shipping_charge = 0;
        }
        if($cart_total_amount < 0) {
            $total_amount = 0;
        }
        else {
            // dd($cart_total_amount, $shipping_charge, $card_price, $packaging_price);
            $total_amount = $cart_total_amount + $shipping_charge + $card_price + $packaging_price;
        }
        $invoice_date = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');


        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";


        $post_data['notes']                 = (!empty($request->notes))?$request->notes:NULL;
        $post_data['delivery_date']         = (!empty($request->delivery_date))?$request->delivery_date:NULL;
        $post_data['shipping_charge']       = $shipping_charge;
        $post_data['shipping_charge_id']    = $get_shipping_charge->id;
        $post_data['payment_type']          = 2;
        $post_data['coupon_code']           = (!empty($request->coupon_code))?$request->coupon_code:NULL;
        $post_data['coupon_amount']         = (!empty($request->coupon_amount))?$request->coupon_amount:NULL;
        $post_data['discountType']          = (!empty($request->coupon_amount))?2:0;

        $post_data['card_id']               = (!empty($request->card_id))?$request->card_id:NULL;
        $post_data['card_price']            = (!empty($request->card_price))?$request->card_price:0;
        $post_data['packaging_id']          = (!empty($request->packaging_id))?$request->packaging_id:NULL;
        $post_data['packaging_price']       = (!empty($request->packaging_price))?$request->packaging_price:0;
        $post_data['personal_notes']        = (!empty($request->personal_notes))?$request->personal_notes:NULL;


        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $post_data['account_password']      = (!empty($request->account_password))?$request->account_password:$request->phone;

            $username = explode(" ", $post_data['cus_name']);
            $ex_email = User::where('email', $post_data['cus_email'])->first();
            $ex_phone = User::where('phone', $post_data['cus_phone'])->first();
            if(isset($ex_email) && isset($ex_phone)){
                $userID = $ex_email->id;
            }elseif (isset($ex_email)){
                $userID = $ex_email->id;
            }elseif (isset($ex_phone)){
                $userID = $ex_phone->id;
            }else{
                $user = User::create([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => $post_data['cus_email'],
                    'phone'         => $post_data['cus_phone'],
                    'address'       => $post_data['cus_add1'],
                    'password'      => (!empty($post_data['account_password']))?Hash::make($post_data['account_password']):Hash::make($post_data['cus_phone']),
                    'status'        => 1
                ]);
                $userID = $user->id;
            }

            /*if (isset($ex_phone)){
                $userID = $ex_phone->id;
            }else{
                $user = User::create([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => $post_data['cus_email'],
                    'phone'         => $post_data['cus_phone'],
                    'address'       => $post_data['cus_add1'],
                    'password'      => (!empty($post_data['account_password']))?Hash::make($post_data['account_password']):Hash::make($post_data['cus_phone']),
                    'status'        => 1
                ]);
                $userID = $user->id;
            }*/

            //User Update after OTP Verify
            /*$userUpdate = User::where('id', $userID)->first();
            if(isset($userUpdate)){
                $userUpdate->update([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => (!empty($post_data['cus_email']))?$post_data['cus_email']:NULL,
                    'address'       => (!empty($post_data['cus_add1']))?$post_data['cus_add1']:NULL,
                ]);
            }*/

            $customer = Customer::create([
                'company_id'                    => 0,
                'customer_name'                 => $post_data['cus_name'],
                'customer_email'                => $post_data['cus_email'],
                'customer_phone'                => $post_data['cus_phone'],
                'customer_address'              => $post_data['cus_add1'],
                'status'                        => 1,
                'created_by'                    => $userID,
            ]);

            $post_data['shipping_name']         = isset($request->shipping_name) ? $request->shipping_name : '';
            $post_data['shipping_phone']        = isset($request->shipping_phone) ? $request->shipping_phone : '';
            $post_data['shipping_email']        = isset($request->shipping_email) ? $request->shipping_email : '';
            $post_data['shipping_address']      = isset($request->shipping_address) ? $request->shipping_address : '';

            $shipping = Shipping::create([
                'company_id'                    => 0,
                'shipping_name'                 => $post_data['shipping_name'],
                'shipping_email'                => $post_data['shipping_phone'],
                'shipping_phone'                => $post_data['shipping_email'],
                'shipping_address'              => $post_data['shipping_address'],
                'status'                        => 1,
                'created_by'                    => $userID,
            ]);


            #Before  going to initiate the payment order status need to update as Pending.
            $order_data = DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'orderId'                   => Helper::autoOrderIdGenereate(),
                    'shipping_id'               => $shipping->id,
                    'user_id'                   => $userID,
                    'customer_id'               => $customer->id,
                    'ship_to_gift'              => $request->shippingDisplay == 'true'?1:0,
                    'shipping_agent_id'         => 0,
                    'invoice_last_digit'        => Helper::autoInvoiceLastDigit(),
                    'invoice_no_old'            => Helper::autoOrderInvoiceNoGenereate(),
                    'invoice_no'                => Helper::autoOrderNewInvoiceNoGenereate(),
                    'invoice_date'              => $invoice_date,
                    'delivery_date'             => $post_data['delivery_date'],
                    'payment_type'              => $post_data['payment_type'],
                    'name'                      => $post_data['cus_name'],
                    'phone'                     => $post_data['cus_phone'],
                    'email'                     => $post_data['cus_email'],
                    'address'                   => $post_data['cus_add1'],
                    'notes'                     => $post_data['notes'],
                    'card_id'                   => $post_data['card_id'],
                    'card_price'                => $post_data['card_price'],
                    'packaging_id'              => $post_data['packaging_id'],
                    'packaging_price'           => $post_data['packaging_price'],
                    'personal_notes'            => $post_data['personal_notes'],
                    'total_amount'              => $total_amount,
                    'discount_type'             => $post_data['discountType'],
                    'discount_amount'           => 0,
                    'shipping_charge_id'        => $post_data['shipping_charge_id'],
                    'shipping_charge'           => $post_data['shipping_charge'],
                    'net_receiveable_amount'    => $total_amount,
                    'collect_amount'            => 0,
                    'return_amount'             => 0,
                    'total_vat'                 => 0,
                    'coupon_code'               => $post_data['coupon_code'],
                    'coupon_amount'             => $post_data['coupon_amount'],
                    'due_amount'                => $total_amount,
                    'transaction_id'            => $post_data['tran_id'],
                    'currency'                  => $post_data['currency'],
                    'status'                    => 'Pending',
                    'created_by'                => 1,
                    'created_at'                => Carbon::now(),
                    'updated_at'                => Carbon::now()
                ]);

            $order_detials = DB::table('orders')->where('transaction_id', $post_data['tran_id'])->first();
            $userID         = $order_detials->user_id;
            $discount_price = 0;
            $total_vat      = 0;
            foreach ($carts as $cart) {
                $discount_price += $cart['product']->discount_price;
                $total_vat      += $cart['product']->vat;

                // $company_id = Product::where('id', $cart->id)->first()->company_id;
                $product_data = Product::where('id', $cart['product']->id)->first();
                $company_id = $product_data !== null ? $product_data->company_id : 0;
                $order_details = OrderDetail::create([
                    'company_id'        => $company_id,
                    'order_id'          => $order_detials->id,
                    'product_id'        => $cart['product']->id,
                    'price'             => $cart['product']->sales_price ? $cart['product']->sales_price : $cart['product']->regular_price,
                    'quantity'          => $cart['qty'],
                    'total_amount'      => $cart['product']->price * $cart['qty'],
                    'transaction_id'    => $order_detials->transaction_id,
                    'status'            => 'Pending',
                    'created_by'        => $userID
                ]);


                // if(!empty($cart->attributes['color']) || !empty($cart->attributes['size']) || !empty($cart->attributes['weight'])){
                //     $order_attributes = OrderAttribute::create([
                //         'company_id'         => $company_id,
                //         'order_id'           => $order_detials->id,
                //         'product_id'         => $cart->id,
                //         'color'              => $cart->attributes['color'],
                //         'size'               => $cart->attributes['size'],
                //         'weight'             => $cart->attributes['weight'],
                //         'status'             => 1,
                //     ]);
                // }
                // dd($order_details, $order_data);
                // $variationId = $cart->attributes['variation_id'];
                $variationId = $cart['product']->variation_id;
                // if($variationId != null){
                //     // dd($order_details, $variationId);
                //     $prev_stock = ProductVariation::where('status', 1)->where('id', $variationId)->first();
                //     if(isset($prev_stock)){
                //         $new_stock = ($prev_stock->attribute_stock) - ($cart['qty']);
                //         $prev_stock->update(['attribute_stock' => $new_stock]);
                //     }



                //     $stock_ledger = StockLedger::create([
                //         'company_id'  => $company_id,
                //         'invoice_no'  => $order_details->invoice_no,
                //         'invoice_date'=> $order_details->invoice_date,
                //         'product_id'  => $cart['product']->id,
                //         'variation_id'=> $variationId,
                //         'stock_in'    => 0,
                //         'stock_out'   => $cart['qty'],
                //         'ledger_type' => 2,
                //         'status'      => 1,
                //         'created_by'  => $userID
                //     ]);
                // }else{
                //     $stock_ledger = StockLedger::create([
                //         'company_id'  => $company_id,
                //         'invoice_no'  => $order_details->invoice_no,
                //         'invoice_date'=> $order_details->invoice_date,
                //         'product_id'  => $cart['product']->id,
                //         'variation_id'=> NULL,
                //         'stock_in'    => 0,
                //         'stock_out'   => $cart['qty'],
                //         'ledger_type' => 2,
                //         'status'      => 1,
                //         'created_by'  => $userID
                //     ]);
                // }
            }

            //Order Update
            if(!empty($discount_price)){
                // $net_receiveable_amount = ($order_detials->net_receiveable_amount) - $discount_price;
                if($order_detials->coupon_amount > 0){
                    $total_discount = $discount_price + ($order_detials->coupon_amount);
                }else{
                    $total_discount = $discount_price;
                }
                $order_update = Order::where('id', $order_detials->id)->update([
                    'discount_type'             => 0,
                    'discount_amount'           => $total_discount,
                    // 'net_receiveable_amount'    => $net_receiveable_amount,
                    // 'due_amount'                => $net_receiveable_amount,
                    // 'total_amount'              => $net_receiveable_amount
                ]);
            }



            if(!empty($total_vat)){
                $orderInfo = Order::find($order_detials->id);
                $orderUpdate = $orderInfo->update([
                    'net_receiveable_amount'    => $orderInfo->net_receiveable_amount + $total_vat,
                    'due_amount'                => $orderInfo->net_receiveable_amount + $total_vat,
                    'total_vat'                 => $total_vat,
                    'total_amount'              => $orderInfo->net_receiveable_amount + $total_vat
                ]);
            }

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $post = $_POST['cart_json'];
        $allData = json_decode($post);
        $errors = [];
        if($allData->cus_name == ''){
            array_push($errors, [
                'errors' => [
                    'name'                  => ['The name field is required.'],
                    'phone'                 => ['The phone field is required.'],
                    'address'               => ['The address field is required.'],
                    'shipping_charge_id'    => ['The shipping method field is required.'],
                ]
            ]);
            return $errors;
        }
        else if($allData->cus_phone == '') {
            array_push($errors, [
                'errors' => [
                    'phone'                 => ['The phone field is required.'],
                ]
            ]);
            return $errors;
        }
        else if($allData->cus_addr1 == '') {
            array_push($errors, [
                'errors' => [
                    'address'               => ['The address field is required.'],
                ]
            ]);
            return $errors;
        }
        else if($allData->shipping_charge_id == 0) {
            array_push($errors, [
                'errors' => [
                    'shipping_charge_id'    => ['The shipping method field is required.'],
                ]
            ]);
            return $errors;
        }
        else{
            $post_data = array();
            //$post_data['total_amount']        = '10'; # You cant not pay less than 10
            $post_data['total_amount']          = $allData->amount; # You cant not pay less than 10
            $post_data['currency']              = "BDT";
            $post_data['tran_id']               = uniqid(); // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name']              = $allData->cus_name;
            $post_data['cus_email']             = (!empty($allData->cus_email))?$allData->cus_email:NULL;
            $post_data['cus_add1']              = $allData->cus_addr1;
            $post_data['cus_add2']              = "";
            $post_data['cus_city']              = "";
            $post_data['cus_state']             = "";
            $post_data['cus_postcode']          = "";
            $post_data['cus_country']           = "Bangladesh";
            $post_data['cus_phone']             = $allData->cus_phone;
            $post_data['cus_fax']               = "";

            $post_data['notes']                 = (!empty($allData->notes))?$allData->notes:NULL;
            $post_data['delivery_date']         = (!empty($allData->delivery_date))?$allData->delivery_date:NULL;
            $post_data['shipping_charge']       = (!empty($allData->shipping_charge))?$allData->shipping_charge:NULL;
            $post_data['shipping_charge_id']    = $allData->shipping_charge_id;
            $post_data['payment_type']          = 2;
            $post_data['coupon_code']           = (!empty($allData->coupon_code))?$allData->coupon_code:NULL;
            $post_data['coupon_amount']         = (!empty($allData->coupon_amount))?$allData->coupon_amount:NULL;
            $post_data['discountType']          = (!empty($allData->coupon_amount))?2:0;

            $post_data['card_id']               = (!empty($allData->card_id))?$allData->card_id:NULL;
            $post_data['card_price']            = (!empty($allData->card_price))?$allData->card_price:0;
            $post_data['packaging_id']          = (!empty($allData->packaging_id))?$allData->packaging_id:NULL;
            $post_data['packaging_price']       = (!empty($allData->packaging_price))?$allData->packaging_price:0;
            $post_data['personal_notes']        = (!empty($allData->personal_notes))?$allData->personal_notes:NULL;

            # SHIPMENT INFORMATION
            $post_data['ship_name']             = "Store Test";
            $post_data['ship_add1']             = "Dhaka";
            $post_data['ship_add2']             = "Dhaka";
            $post_data['ship_city']             = "Dhaka";
            $post_data['ship_state']            = "Dhaka";
            $post_data['ship_postcode']         = "1000";
            $post_data['ship_phone']            = "";
            $post_data['ship_country']          = "Bangladesh";

            $post_data['shipping_method']       = "NO";
            $post_data['product_name']          = "Computer";
            $post_data['product_category']      = "Goods";
            $post_data['product_profile']       = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a']               = "ref001";
            $post_data['value_b']               = "ref002";
            $post_data['value_c']               = "ref003";
            $post_data['value_d']               = "ref004";

            $current_date                       = date('d/m/Y');
            $invoice_date                       = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');
            $shippingStatus                     = $allData->shippingDisplay == 'false' ? 0: 1;

            $post_data['account_password']      = (!empty($allData->account_password))?$allData->account_password:$allData->cus_phone;

            $username = explode(" ", $post_data['cus_name']);
            $ex_email = User::where('email', $post_data['cus_email'])->first();
            $ex_phone = User::where('phone', $post_data['cus_phone'])->first();
            if(isset($ex_email) && isset($ex_phone)){
                $userID = $ex_email->id;
            }elseif (isset($ex_email)){
                $userID = $ex_email->id;
            }elseif (isset($ex_phone)){
                $userID = $ex_phone->id;
            }else{
                $user = User::create([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => $post_data['cus_email'],
                    'phone'         => $post_data['cus_phone'],
                    'address'       => $post_data['cus_add1'],
                    'password'      => (!empty($post_data['account_password']))?Hash::make($post_data['account_password']):Hash::make($post_data['cus_phone']),
                    'status'        => 1
                ]);
                $userID = $user->id;
            }

            /*if (isset($ex_phone)){
                $userID = $ex_phone->id;
            }else{
                $user = User::create([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => $post_data['cus_email'],
                    'phone'         => $post_data['cus_phone'],
                    'address'       => $post_data['cus_add1'],
                    'password'      => (!empty($post_data['account_password']))?Hash::make($post_data['account_password']):Hash::make($post_data['cus_phone']),
                    'status'        => 1
                ]);
                $userID = $user->id;
            }*/

            //User Update after OTP Verify
            /*$userUpdate = User::where('id', $userID)->first();
            if(isset($userUpdate)){
                $userUpdate->update([
                    'name'          => $post_data['cus_name'],
                    'username'      => $username[0],
                    'email'         => (!empty($post_data['cus_email']))?$post_data['cus_email']:NULL,
                    'address'       => (!empty($post_data['cus_add1']))?$post_data['cus_add1']:NULL,
                ]);
            }*/

            $customer = Customer::create([
                'company_id'                    => 0,
                'customer_name'                 => $post_data['cus_name'],
                'customer_email'                => $post_data['cus_email'],
                'customer_phone'                => $post_data['cus_phone'],
                'customer_address'              => $post_data['cus_add1'],
                'status'                        => 1,
                'created_by'                    => $userID,
            ]);

            $post_data['shipping_name']         = $allData->shipping_name;
            $post_data['shipping_phone']        = $allData->shipping_phone;
            $post_data['shipping_email']        = $allData->shipping_email;
            $post_data['shipping_address']      = $allData->shipping_address;

            $shipping = Shipping::create([
                'company_id'                    => 0,
                'shipping_name'                 => $post_data['shipping_name'],
                'shipping_email'                => $post_data['shipping_phone'],
                'shipping_phone'                => $post_data['shipping_email'],
                'shipping_address'              => $post_data['shipping_address'],
                'status'                        => 1,
                'created_by'                    => $userID,
            ]);


            #Before  going to initiate the payment order status need to update as Pending.
            $update_product = DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'orderId'                   => Helper::autoOrderIdGenereate(),
                    'shipping_id'               => $shipping->id,
                    'user_id'                   => $userID,
                    'customer_id'               => $customer->id,
                    'ship_to_gift'              => $allData->shippingDisplay == 'true'?1:0,
                    'shipping_agent_id'         => 0,
                    'invoice_last_digit'        => Helper::autoInvoiceLastDigit(),
                    'invoice_no_old'            => Helper::autoOrderInvoiceNoGenereate(),
                    'invoice_no'                => Helper::autoOrderNewInvoiceNoGenereate(),
                    'invoice_date'              => $invoice_date,
                    'delivery_date'             => $post_data['delivery_date'],
                    'payment_type'              => $post_data['payment_type'],
                    'name'                      => $post_data['cus_name'],
                    'phone'                     => $post_data['cus_phone'],
                    'email'                     => $post_data['cus_email'],
                    'address'                   => $post_data['cus_add1'],
                    'notes'                     => $post_data['notes'],
                    'card_id'                   => $post_data['card_id'],
                    'card_price'                => $post_data['card_price'],
                    'packaging_id'              => $post_data['packaging_id'],
                    'packaging_price'           => $post_data['packaging_price'],
                    'personal_notes'            => $post_data['personal_notes'],
                    'total_amount'              => $post_data['total_amount'],
                    'discount_type'             => $post_data['discountType'],
                    'discount_amount'           => 0,
                    'shipping_charge_id'        => $post_data['shipping_charge_id'],
                    'shipping_charge'           => $post_data['shipping_charge'],
                    'net_receiveable_amount'    => $post_data['total_amount'],
                    'collect_amount'            => 0,
                    'return_amount'             => 0,
                    'total_vat'                 => 0,
                    'coupon_code'               => $post_data['coupon_code'],
                    'coupon_amount'             => $post_data['coupon_amount'],
                    'due_amount'                => $post_data['total_amount'],
                    'transaction_id'            => $post_data['tran_id'],
                    'currency'                  => $post_data['currency'],
                    'status'                    => 'Pending',
                    'created_by'                => 1,
                    'created_at'                => Carbon::now(),
                    'updated_at'                => Carbon::now()
                ]);

            $order_detials = DB::table('orders')->where('transaction_id', $post_data['tran_id'])->first();

            $carts          = \Cart::getContent();
            $userID         = $order_detials->user_id;
            $discount_price = 0;
            $total_vat      = 0;
            foreach ($carts as $cart) {
                $discount_price += $cart->attributes['discount_price'];
                $total_vat      += $cart->attributes['vat'];

                $company_id = Product::where('id', $cart->id)->first()->company_id;
                OrderDetail::create([
                    'company_id'        => $company_id,
                    'order_id'          => $order_detials->id,
                    'product_id'        => $cart->id,
                    'price'             => $cart->price,
                    'quantity'          => $cart->quantity,
                    'total_amount'      => $cart->price * $cart->quantity,
                    'transaction_id'    => $order_detials->transaction_id,
                    'status'            => 'Pending',
                    'created_by'        => $userID
                ]);

                if(!empty($cart->attributes['color']) || !empty($cart->attributes['size']) || !empty($cart->attributes['weight'])){
                    $order_attributes = OrderAttribute::create([
                        'company_id'         => $company_id,
                        'order_id'           => $order_detials->id,
                        'product_id'         => $cart->id,
                        'color'              => $cart->attributes['color'],
                        'size'               => $cart->attributes['size'],
                        'weight'             => $cart->attributes['weight'],
                        'status'             => 1,
                    ]);
                }

                $variationId = $cart->attributes['variation_id'];
                if(!empty($variationId)){
                    $prev_stock = ProductVariation::where('status', 1)->where('id', $variationId)->first();
                    if(isset($prev_stock)){
                        $new_stock = ($prev_stock->attribute_stock) - ($cart->quantity);
                        $prev_stock->update(['attribute_stock' => $new_stock]);
                    }

                    $stock_ledger = StockLedger::create([
                        'company_id'  => $company_id,
                        'invoice_no'  => $order_detials->invoice_no,
                        'invoice_date'=> $order_detials->invoice_date,
                        'product_id'  => $cart->id,
                        'variation_id'=> $variationId,
                        'stock_in'    => 0,
                        'stock_out'   => $cart->quantity,
                        'ledger_type' => 2,
                        'status'      => 1,
                        'created_by'  => $userID
                    ]);
                }else{
                    $stock_ledger = StockLedger::create([
                        'company_id'  => $company_id,
                        'invoice_no'  => $order_detials->invoice_no,
                        'invoice_date'=> $order_detials->invoice_date,
                        'product_id'  => $cart->id,
                        'variation_id'=> NULL,
                        'stock_in'    => 0,
                        'stock_out'   => $cart->quantity,
                        'ledger_type' => 2,
                        'status'      => 1,
                        'created_by'  => $userID
                    ]);
                }
            }

            //Order Update
            if(!empty($discount_price)){
                // $net_receiveable_amount = ($order_detials->net_receiveable_amount) - $discount_price;
                if($order_detials->coupon_amount > 0){
                    $total_discount = $discount_price + ($order_detials->coupon_amount);
                }else{
                    $total_discount = $discount_price;
                }
                $order_update = Order::where('id', $order_detials->id)->update([
                    'discount_type'             => 0,
                    'discount_amount'           => $total_discount,
                    // 'net_receiveable_amount'    => $net_receiveable_amount,
                    // 'due_amount'                => $net_receiveable_amount,
                    // 'total_amount'              => $net_receiveable_amount
                ]);
            }

            if(!empty($total_vat)){
                $orderInfo = Order::find($order_detials->id);
                $orderUpdate = $orderInfo->update([
                    'net_receiveable_amount'    => $orderInfo->net_receiveable_amount + $total_vat,
                    'due_amount'                => $orderInfo->net_receiveable_amount + $total_vat,
                    'total_vat'                 => $total_vat,
                    'total_amount'              => $orderInfo->net_receiveable_amount + $total_vat
                ]);
            }

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
    }

    public function success(Request $request)
    {
        //echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        // $order_detials = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();
        $order_detials = DB::table('orders')->where('transaction_id', $tran_id)->first();
        $order_details_items = OrderDetail::where('order_id', $order_detials->id)->get();

        foreach($order_details_items as $order_detail) {
            $product_stock = new ProductStock();
            $product_stock->product_id = $order_detail->product_id;
            $product_stock->company_id = $order_detail->company_id;
            $product_stock->type = "sell";
            $product_stock->qty  = $order_detail->quantity;
            $product_stock->save();
        }
        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                //Custom Code Start--------------------------------------------------------------------------------------------------//
                //Send Mail Start---------------------------------------
                $data['order'] = $orderInfo = Order::find($order_detials->id);
                $userID        = $order_detials->user_id;
                //To Admin----------------------------------------------------------------------------------------------------
                $admin_data['info'] = [
                    'name'              => $orderInfo->name,
                    'email'             => $orderInfo->email,
                    'phone'             => $orderInfo->phone,
                    'orderId'           => $orderInfo->orderId,
                    'total'             => $orderInfo->total_amount,
                    'total_vat'         => $orderInfo->total_vat,
                    'shipping_charge'   => $orderInfo->shipping_charge,
                    'card_price'        => $orderInfo->card_price,
                    'packaging_price'   => $orderInfo->packaging_price,
                    'discount_amount'   => $orderInfo->discount_amount,
                    'net_receivable'    => $orderInfo->net_receiveable_amount,
                ];
                $admin_data['orderdetails'] = OrderDetail::join('products','products.id','=','order_details.product_id')
                    ->select('order_details.*','products.product_name','products.product_sku')
                    ->where('order_details.order_id', $order_detials->id)
                    ->get();
                $admin_email = ['sumaia.geeky@gmail.com','rakib.geeky@gmail.com','sagorace.017@gmail.com','info@stygen.gift'];
                \Mail::send(['html'=>'email.order_admin'], $admin_data, function($message) use ($admin_email) {
                    $message->to($admin_email)->subject('New Order Confirmation');
                    $message->from('order@stygen.gift','STYGEN');
                });
                //To Admin----------------------------------------------------------------------------------------------------

                // //To Seller----------------------------------------------------------------------------------------------------
                // $companyIds = [];
                // $orderDetails    = OrderDetail::where('order_id', $order_detials->id)->select('company_id')->get();
                // foreach($orderDetails as $orderDetail){
                //     array_push($companyIds, $orderDetail->company_id);
                // }
                // $seller_emails = Seller::whereIn('company_id', $companyIds)->get();
                // if($seller_emails->count() > 0){
                //     foreach($seller_emails as $sellerInfo){
                //         $seller_data['info'] = [
                //             'name'              => $orderInfo->name,
                //             'email'             => $orderInfo->email,
                //             'phone'             => $orderInfo->phone,
                //             'orderId'           => $orderInfo->orderId,
                //             'seller_name'       => $sellerInfo->name,
                //         ];
                //         $seller_data['orderdetails'] = OrderDetail::join('products','products.id','=','order_details.product_id')
                //             ->select('order_details.*','products.product_name','products.product_sku')
                //             ->where('order_details.order_id', $order_detials->id)
                //             ->where('order_details.company_id', $sellerInfo->company_id)
                //             ->get();

                //         $seller_email = $sellerInfo->email;

                //         if(!blank($seller_email)){
                //             \Mail::send(['html'=>'email.order_seller'], $seller_data, function($message) use ($seller_email) {
                //                 $message->to($seller_email)->subject('New Order Confirmation');
                //                 $message->from('order@stygen.gift','STYGEN');
                //             });
                //         }
                //     }
                // }
                //To Seller----------------------------------------------------------------------------------------------------

                //TO User-----------------------------------------------------------------------------------------------------
                $customer_email = $order_detials->email;

                if(!blank($customer_email) && $customer_email != 'null' && $customer_email != NULL){
                    $user_email = $customer_email;
                    $data['order_details'] = OrderDetail::join('products','products.id','=','order_details.product_id')
                        ->select('order_details.*','products.product_name','products.product_sku')
                        ->where('order_details.order_id', $order_detials->id)
                        ->get();
                    $data['user'] = User::where('id', $userID)->first();


                    \Mail::send(['html'=>'email.order'], $data, function($message) use ($user_email) {
                        $message->to($user_email)->subject('New Order Confirmation');
                        $message->from('order@stygen.gift','STYGEN');
                    });
                }
                //TO User-----------------------------------------------------------------------------------------------------
                //Send Mail End-----------------------------------------

                \Cart::clear();
                Auth::loginUsingId($userID);
                $orderID = $order_detials->id;
                return redirect('thank-you/'.$orderID);
                //Custom Code End--------------------------------------------------------------------------------------------------//

                echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Pending']);

                $orderID = $order_detials->id;
                return redirect('payment-failed?order_id='.$orderID);

                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $orderID = $order_detials->id;
            return redirect('thank-you/'.$orderID);

            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            $orderID = $order_detials->id;
            return redirect('payment-failed?order_id='.$orderID);

            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        // $order_detials = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();
        $order_detials = DB::table('orders')->where('transaction_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Pending']);
            $orderID = $order_detials->id;
            return redirect('payment-failed?order_id='.$orderID);

            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $orderID = $order_detials->id;
            return redirect('thank-you/'.$orderID);

            echo "Transaction is already Successful";
        } else {
            $orderID = $order_detials->id;
            return redirect('payment-failed?order_id='.$orderID);

            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')->where('transaction_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            return redirect('/');

            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $orderID = $order_detials->id;
            return redirect('thank-you/'.$orderID);

            echo "Transaction is already Successful";
        } else {
            return redirect('/');

            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')->where('transaction_id', $tran_id)->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->total_amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Pending']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
