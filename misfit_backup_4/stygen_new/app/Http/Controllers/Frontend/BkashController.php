<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\CartManagerController;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Shipping;
use App\Models\ShippingCharge;
use App\Models\StockLedger;
use App\Models\User;
use App\Models\ProductStock;
use Carbon\Carbon;
use DateTime;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BkashController extends Controller
{
    private $cart_handler;

    public function bkashCheckout(Request $request) {
        $token = $this->bkash_Get_Token();

        $request->session()->put('token', $token);

        $this->cart_handler = new CartManagerController();

        $shippingStatus = $request->shippingDisplay;

        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'address'           => 'required',
            'phone'             => 'required',
            'shipping_charge_id' => ['required','exists:shipping_charges,id'],
            'shipping_name'     => ['required_if:shippingDisplay,==,ship_to_other'],
            'shipping_address'  => ['required_if:shippingDisplay,==,ship_to_other'],
            'shipping_phone'    => ['required_if:shippingDisplay,==,ship_to_other'],
        ]);

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
            $total_amount       = $cart_total_amount + $shipping_charge + $card_price + $packaging_price;
        }

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }


        if(!empty($request->user_id)){
            $userID             = Auth::user()->id;
        }else{
            $username = explode(" ", $request->name);
            $ex_email = User::where('email', $request->email)->first();
            $ex_phone = User::where('phone', $request->phone)->first();
            if(isset($ex_email) && isset($ex_phone)){
                $userID = $ex_email->id;
            }elseif (isset($ex_email)){
                $userID = $ex_email->id;
            }elseif (isset($ex_phone)){
                $userID = $ex_phone->id;
            }else{
                $user = User::create([
                    'name'          => $request->name,
                    'username'      => $username[0],
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'address'       => $request->address,
                    'password'      => (!empty($request->account_password))?Hash::make($request->account_password):Hash::make($request->phone),
                    'status'        => 1
                ]);
                $userID = $user->id;
            }
        }

        $model                  = DB::table('stock_ledgers');
        $ledgerType             = 4;
        $invoice_no             = Helper::autoInvoiceNoGenereateBasicUser($model, $ledgerType, $userID);

        if($shippingStatus == 1) {
            $shipping = Shipping::create([
                'company_id'        => 0,
                'shipping_name'     => $request->shipping_name,
                'shipping_email'    => $request->shipping_email,
                'shipping_phone'    => $request->shipping_phone,
                'shipping_address'  => $request->shipping_address,
                'status'            => 1,
                'created_by'        => $userID,
            ]);
        } else {
            $shipping = Shipping::create([
                'company_id'        => 0,
                'shipping_name'     => $request->name,
                'shipping_email'    => $request->email,
                'shipping_phone'    => $request->phone,
                'shipping_address'  => $request->address,
                'status'            => 1,
                'created_by'        => $userID,
            ]);
        }

        $customer = Customer::create([
            'company_id'        => 0,
            'customer_name'     => $request->name,
            'customer_email'    => $request->email,
            'customer_phone'    => $request->phone,
            'customer_address'  => $request->address,
            'status'            => 1,
            'created_by'        => $userID,
        ]);

        $order = Order::create([
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
            'delivery_date'             => $request->delivery_date,
            'payment_type'              => 1,
            'name'                      => $request->name,
            'phone'                     => $request->phone,
            'email'                     => $request->email,
            'address'                   => $request->address,
            'notes'                     => $request->notes,
            'card_id'                   => $card_id,
            'card_price'                => $card_price,
            'packaging_id'              => $packaging_id,
            'packaging_price'           => $packaging_price,
            'personal_notes'            => $personal_notes,
            'total_amount'              => $total_amount,
            'discount_amount'           => 0,
            'shipping_charge_id'        => $request->shipping_charge_id,
            'shipping_charge'           => $shipping_charge,
            'net_receiveable_amount'    => $total_amount,
            'collect_amount'            => 0,
            'return_amount'             => 0,
            'total_vat'                 => 0,
            'due_amount'                => $total_amount,
            'transaction_id'            => uniqid(),
            'currency'                  => 'BDT',
            'status'                    => 'Pending',
            'created_by'                => $userID,
        ]);

        if($order) {
            $discount_price = 0;
            $total_vat      = 0;

            foreach ($carts as $cart) {

                $discount_price += $cart['product']->discount_price;
                $total_vat      += $cart['product']->vat;

                $product_data = Product::where('id', $cart['product']->id)->first();
                $company_id = $product_data !== null ? $product_data->company_id : 0;
                $order_details = OrderDetail::create([
                    'company_id'        => $company_id ? $company_id : 0,
                    'order_id'          => $order->id,
                    'product_id'        => $cart['product']->id,
                    'price'             => $cart['product']->sales_price ? $cart['product']->sales_price : $cart['product']->regular_price,
                    'quantity'          => $cart['qty'],
                    'total_amount'      => $cart['product']->price * $cart['qty'],
                    'transaction_id'    => $order->transaction_id,
                    'status'            => 'Pending',
                    'created_by'        => $userID
                ]);

                // if(!empty($cart->attributes['color']) || !empty($cart->attributes['size']) || !empty($cart->attributes['weight'])){
                //     $order_attributes = OrderAttribute::create([
                //         'company_id'         => $company_id,
                //         'order_id'           => $order->id,
                //         'product_id'         => $cart->id,
                //         'color'              => $cart->attributes['color'],
                //         'size'               => $cart->attributes['size'],
                //         'weight'             => $cart->attributes['weight'],
                //         'status'             => 1,
                //     ]);
                // }

                $variationId = $cart['product']->variation_id;
                if(!empty($variationId)){
                    $prev_stock = ProductVariation::where('status', 1)->where('id', $variationId)->first();
                    if(isset($prev_stock)){
                        $new_stock = ($prev_stock->attribute_stock) - ($cart['qty']);
                        $prev_stock->update(['attribute_stock' => $new_stock]);
                    }

                    $stock_ledger = StockLedger::create([
                        'company_id'  => $company_id,
                        'invoice_no'  => $invoice_no,
                        'invoice_date'=> $invoice_date,
                        'product_id'  => $cart['product']->id,
                        'variation_id'=> $variationId,
                        'stock_in'    => 0,
                        'stock_out'   => $cart['qty'],
                        'ledger_type' => 2,
                        'status'      => 1,
                        'created_by'  => $userID
                    ]);
                }else{
                    $stock_ledger = StockLedger::create([
                        'company_id'  => $company_id,
                        'invoice_no'  => $invoice_no,
                        'invoice_date'=> $invoice_date,
                        'product_id'  => $cart['product']->id,
                        'variation_id'=> NULL,
                        'stock_in'    => 0,
                        'stock_out'   => $cart['qty'],
                        'ledger_type' => 2,
                        'status'      => 1,
                        'created_by'  => $userID
                    ]);
                }

            }

            //Order Update
            // $discount_price = (!empty($discount_price))?$discount_price:0;
            $coupon_amount = (!empty($coupon_amount))?$coupon_amount:0;

            $net_receiveable_amount = ($order->net_receiveable_amount) - $coupon_amount;
            if(isset($coupon_code)) {
                $coupon = Coupon::where('code', $coupon_code)->where('status', 1)->first();
                if($coupon->coupon_type != 'permanent') {
                    $coupon->update([
                        'coupon_spent' => 1,
                        'spent_at' => Carbon::now()
                    ]);
                }
            }

            $order_update = Order::where('id', $order->id)->update([
                'coupon_code'               => $coupon_code,
                'coupon_amount'             => $coupon_amount,
                'discount_type'             => (!empty($coupon_amount))?2:0,
                'discount_amount'           => $coupon_amount,
                'net_receiveable_amount'    => $net_receiveable_amount,
                'due_amount'                => $net_receiveable_amount,
                'total_amount'              => $net_receiveable_amount
            ]);


            if(!empty($total_vat)){
                $orderInfo = Order::find($order->id);
                $orderUpdate = $orderInfo->update([
                    'net_receiveable_amount'    => $orderInfo->net_receiveable_amount + $total_vat,
                    'due_amount'                => $orderInfo->net_receiveable_amount + $total_vat,
                    'total_vat'                 => $total_vat,
                    'total_amount'              => $orderInfo->net_receiveable_amount + $total_vat
                ]);
            }

            // mailchimp user entry start

            // if(isset($request->email) && $request->email != 'null') {

            //     $client = new \MailchimpMarketing\ApiClient();

            //     $client->setConfig([
            //         'apiKey' => config('services.mailchimp.key'),
            //         'server' => 'us20',
            //     ]);

            //     $order_email = $request->email;

            //     $customer = $client->ecommerce->addStoreCustomer("stygen", [
            //         "id" => "stg_$customer->id",
            //         "email_address" => "$order_email",
            //         "opt_in_status" => true,
            //         "status" => "customer",
            //         "company" => "Stygen",
            //         "address" => [
            //             "address1"=> "$request->address",
            //             "country"=> "Bangladesh",
            //             "country_code"=> "BD"
            //         ],
            //         "created_at" => "$order->created_at",
            //         "updated_at" => "$order->updated_at"
            //     ]);

            // }
            // // mailchimp user entry end

            // $this->cart_handler->emptyCart();
            // Auth::loginUsingId($userID);
            $orderID = $order->id;
            return response()->json($orderID);
        }
    }

    public function visit(Request $request)
    {

        $products                  = \Cart::getContent();

        if($request->session()->has('shipping_charge')) {
            $shipping_cost = $request->session()->get('shipping_charge');
        }else {
            $shipping_cost = 0;
        }
        $invoice = Helper::autoOrderNewInvoiceNoGenereate();


        $request->session()->put('invoice',$invoice);

        $cart_total      = \Cart::getTotal();

        $total = $cart_total + $shipping_cost;
        $token = $this->bkash_Get_Token();

        $request->session()->put('token', $token);

        return view('frontend.bkash_payment', compact('products', 'shipping_cost', 'total', 'cart_total', 'invoice'));
    }




    // public function token() {
    //     session_start();

    //     $request_token = $this->bkash_Get_Token();
    //     $idtoken = $request_token['id_token'];

    //     $_SESSION['token']=$idtoken;

    //     // $strJsonFileContents = file_get_contents("config.json");
    //     // $array = json_decode($strJsonFileContents, true);
    //     $array = $this->_get_config_file();

    //     $array['token']=$idtoken;

    //     $newJsonString = json_encode($array);
    //     // file_put_contents('config.json',$newJsonString);
    //     File::put(storage_path() . '/app/public/config.json', $newJsonString);

    //     echo $idtoken;
    // }

    protected function bkash_Get_Token()
    {
        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $post_token=array(
            'app_key'=>$array["app_key"],
            'app_secret'=>$array["app_secret"]
        );

        $url=curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken=json_encode($post_token);
        $header=array(
            'Content-Type:application/json',
            'password:'.$array["password"],
            'username:'.$array["username"]
        );

        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata=curl_exec($url);
        curl_close($url);
        $arr = json_decode($resultdata, true);
        return $arr['id_token'];
    }

    protected function _get_config_file()
    {
        $path = storage_path() . "/app/public/config.json";
        return json_decode(file_get_contents($path), true);
    }

    public function createpayment(Request $request) {
        // dd(request()->shoppingID);
        session_start();
        $this->cart_handler = new CartManagerController();
        // $strJsonFileContents = file_get_contents("config.json");
        // $array = json_decode($strJsonFileContents, true);
        $array = $this->_get_config_file();

        $order_data = Order::where('id', $request->order_id)->first();

        $shipping_cost = $order_data->shipping_charge;
        $cart_total    = floatval($this->cart_handler->cart_total());

        $amount = $shipping_cost+$cart_total;
        $invoice = Helper::autoOrderNewInvoiceNoGenereate(); // must be unique

        $token = $request->session()->get('token');
        $request->session()->put('bkash_order_id', $request->order_id);

        $intent = "sale";

        $proxy = $array["proxy"];
        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $invoice, 'intent' => $intent);
        // dd($createpaybody);
            $url = curl_init($array["createURL"]);

            $createpaybodyx = json_encode($createpaybody);

            $header=array(
                'Content-Type:application/json',
                'authorization:'.$token,
                'x-app-key:'.$array["app_key"]
            );


            curl_setopt($url,CURLOPT_HTTPHEADER, $header);
            curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
            curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
            //curl_setopt($url, CURLOPT_PROXY, $proxy);

            $resultdata = curl_exec($url);
            curl_close($url);
            $arr = json_decode($resultdata, true);

            $paymentID = $arr['paymentID'];

            $request->session()->put('paymentID',$paymentID);

            return json_decode($resultdata);
    }
    public function executepayment(Request $request) {

        $array = $this->_get_config_file();

        $paymentID = $request->session()->get('paymentID');
        $token = $request->session()->get('token');
        // $proxy = $array["proxy"];

        $url = curl_init($array["executeURL"].$paymentID);

        $header=array(
            'Content-Type:application/json',
            'authorization:'.$token,
            'x-app-key:'.$array["app_key"]
        );

        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdatax=curl_exec($url);
        curl_close($url);

        $arr = json_decode($resultdatax, true);
        if(array_key_exists("errorCode",$arr) && $arr['errorCode'] != '0000'){
            $request->session()->put('errorMessage', $arr['errorMessage']);

        }

        $this->updateOrderStatus($resultdatax, $request);

        // return redirect('/thank-you');

    }
    protected function updateOrderStatus($resultdatax, Request $request) {

        $resultdatax = json_decode($resultdatax);
        // dd($resultdatax);
        $this->cart_handler = new CartManagerController();
        if($resultdatax && isset($resultdatax->trxID)) {
            $order_id = $request->session()->get('bkash_order_id');
            $order = Order::where('id', $order_id)->first();
            $order->transaction_id = $resultdatax->trxID;
            $order->bkash_transaction = $resultdatax->trxID;
            $order->bkash_payment_id = $resultdatax->paymentID;
            $order->status = 'Paid';
            $order->save();

            $order_details = OrderDetail::where('order_id', $order->id)->get();

            foreach($order_details as $order_detail) {

                $product_stock = new ProductStock();
                $product_stock->product_id = $order_detail->product_id;
                $product_stock->company_id = $order_detail->company_id;
                $product_stock->type = "sell";
                $product_stock->qty  = $order_detail->quantity;
                $product_stock->save();
            }



            if($order) {
                //Send Mail Start---------------------------------------
                $data['order'] = $order;
                //To Admin----------------------------------------------------------------------------------------------------
                $admin_data['info'] = [
                    'name'              => $order->name,
                    'email'             => $order->email,
                    'phone'             => $order->phone,
                    'orderId'           => $order->orderId,
                    'total'             => $order->total_amount,
                    'total_vat'         => $order->total_vat,
                    'shipping_charge'   => $order->shipping_charge,
                    'card_price'        => $order->card_price,
                    'packaging_price'   => $order->packaging_price,
                    'discount_amount'   => $order->discount_amount,
                    'net_receivable'    => $order->net_receiveable_amount,
                ];
                $admin_data['orderdetails'] = OrderDetail::join('products','products.id','=','order_details.product_id')
                    ->select('order_details.*','products.product_name','products.product_sku')
                    ->where('order_details.order_id', $order->id)
                    ->get();

                $admin_email = ['sagorace.017@gmail.com','info@stygen.gift'];
                \Mail::send(['html'=>'email.order_admin'], $admin_data, function($message) use ($admin_email) {
                    $message->to($admin_email)->subject('New Order Confirmation');
                    $message->from('order@stygen.gift','STYGEN');
                });
                //To Admin----------------------------------------------------------------------------------------------------


                //TO User-----------------------------------------------------------------------------------------------------
                // $userDetails    = User::where('id', $userID)->first();
                $orderID        = $order->id;
                $customer_email_send = $order->email;

                if(!blank($customer_email_send) && $customer_email_send != 'null' && $customer_email_send != NULL){
                    $user_email = $customer_email_send;
                    $data['order_details'] = $order_details = OrderDetail::join('products','products.id','=','order_details.product_id')
                        ->select('order_details.*','products.product_name','products.product_sku')
                        ->where('order_details.order_id', $order->id)
                        ->get();
                    $data['user'] = $user = User::where('id', $customer_email_send)->first();


                    \Mail::send(['html'=>'email.order'], $data, function($message) use ($user_email, $orderID,
                        $order, $order_details, $user) {
                        $message->to($user_email)->subject('New Order Confirmation');
                        $message->from('order@stygen.gift','STYGEN');
                        // PDF Send

                        // $allData['order'] = $orderInfo;
                        // $allData['order_details'] = $order_details;
                        // $allData['user'] = $user;
                        // $userInfo = $user;
                        // $allData['customerInfo'] = Customer::where('id', $orderInfo->customer_id)->first();
                        // $allData['shippingInfo'] = Shipping::where('id', $orderInfo->shipping_id)->first();
                        // $pdf = PDF::loadView('pdf.order', $allData);
                        // $message->attachData($pdf->output(), 'Order.pdf');
                    });
                }
                //TO User-----------------------------------------------------------------------------------------------------
                //Send Mail End-----------------------------------------
                $this->cart_handler->emptyCart();
            }


            $resultdatax = json_encode($resultdatax);
            echo $resultdatax;
        }else {
            $resultdatax = json_encode($resultdatax);
            echo $resultdatax;
        }

    }
    public function refund(Request $request)
    {
        $paymentID = $request->order['bkash_payment_id'];
        $transaction_id = $request->order['bkash_transaction'];
        $amount = $request->order['total_amount'] - $request->order['shipping_charge'];
        $sku = 'sku-123';
        $reason = 'Refund';
        // dd($paymentID, $transaction_id);
        session_start();
        $token = $this->bkash_Get_Token();
        // $strJsonFileContents = file_get_contents("config.json");
        // $array = json_decode($strJsonFileContents, true);
        $array = $this->_get_config_file();

        $proxy = $array["proxy"];
            $createpaybody = array('paymentID' => $paymentID, 'trxID' => $transaction_id, 'amount' => $amount, 'sku' => $sku, 'reason' => $reason);
            $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/refund');

            $createpaybodyx = json_encode($createpaybody);

            $header=array(
                'Content-Type:application/json',
                'authorization:'.$token,
                'x-app-key:'.$array["app_key"]
            );

            curl_setopt($url,CURLOPT_HTTPHEADER, $header);
            curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
            curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
            //curl_setopt($url, CURLOPT_PROXY, $proxy);

            $resultdata = curl_exec($url);
            curl_close($url);
            // echo $resultdata;

            return response()->json($resultdata);
    }

    public function refund_status(Request $request)
    {
        $paymentID = $request->order['bkash_payment_id'];
        $transaction_id = $request->order['bkash_transaction'];

        // dd($paymentID, $transaction_id);
        session_start();
        $token = $this->bkash_Get_Token();
        // $strJsonFileContents = file_get_contents("config.json");
        // $array = json_decode($strJsonFileContents, true);
        $array = $this->_get_config_file();

        $proxy = $array["proxy"];
            $createpaybody = array('paymentID' => $paymentID, 'trxID' => $transaction_id);
            $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/refund');

            $createpaybodyx = json_encode($createpaybody);

            $header=array(
                'Content-Type:application/json',
                'authorization:'.$token,
                'x-app-key:'.$array["app_key"]
            );

            curl_setopt($url,CURLOPT_HTTPHEADER, $header);
            curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
            curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
            //curl_setopt($url, CURLOPT_PROXY, $proxy);

            $resultdata = curl_exec($url);
            curl_close($url);
            // echo $resultdata;

            return response()->json($resultdata);
    }
    public function thank_you()
    {
        return redirect('/thank-you');
    }
    public function failed(Request $request)
    {

        return view('frontend.fail')->with([
            'errorMessage' => $request->session()->get('errorMessage')
        ]);
    }
}
