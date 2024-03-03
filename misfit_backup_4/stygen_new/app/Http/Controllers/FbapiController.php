<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require __DIR__ . '../../../../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
class FbapiController extends Controller
{
    public function fbapi()
    {
        $access_token = 'EAAIFGqIkUswBAKOwZCoR5sEUt4bD52uCKGznmiZBsNevDZCX09Thltnv4dz0ny2iJdhl2op9lWaf2WA2HTUQ4zwuFkqj7u3a3gddSBpTKkZCZAkOiQyIwP9jYciZA3eIVNysBFlCIL5UmmNzKT2r91rOajrSP4Lx0VOybmprAf0TTZAqNDBrBOHQ2UCrCDpURsZD';
        $pixel_id = '253360395780128';

        $api = Api::init(null, null, $access_token);
        $api->setLogger(new CurlLogger());

        $user_data = (new UserData())
            ->setEmails(array('joe@eg.com'))
            ->setPhones(array('12345678901', '14251234567'))
            // It is recommended to send Client IP and User Agent for Conversions API Events.
            ->setClientIpAddress($_SERVER['REMOTE_ADDR'])
            ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
            ->setFbc('fb.1.1554763741205.AbCdEfGhIjKlMnOpQrStUvWxYz1234567890')
            ->setFbp('fb.1.1558571054389.1098115397');

        $content = (new Content())
            ->setProductId('product123')
            ->setQuantity(1)
            ->setDeliveryCategory(DeliveryCategory::HOME_DELIVERY);

        $custom_data = (new CustomData())
            ->setContents(array($content))
            ->setCurrency('usd')
            ->setValue(123.45);

        $event = (new Event())
            ->setEventName('Purchase')
            ->setEventTime(time())
            ->setEventSourceUrl('http://jaspers-market.com/product/123')
            ->setUserData($user_data)
            ->setCustomData($custom_data)
            ->setActionSource(ActionSource::WEBSITE);

        $events = array();
        array_push($events, $event);

        $request = (new EventRequest($pixel_id))
            ->setEvents($events);
        $response = $request->execute();
        print_r($response);
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
}
