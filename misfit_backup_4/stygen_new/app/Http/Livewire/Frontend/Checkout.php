<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Controllers\CartManagerController;
use App\Models\Card;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Packaging;
use App\Models\ShippingCharge;
use Livewire\Component;

class Checkout extends Component
{
    public $carts;
    public $cards;
    public $cart_amount;
    public $cart_total;
    private $cart_handler;
    public $shippings;
    public $packagings;

    public $card_id = null;
    public $card_price = 0;
    public $packaging_id = null;
    public $packaging_price = 0;
    public $shipping_id = null;
    public $shipping_price = 0;
    public $cart_product_ids = [];

    public $total_amount = null;

    public $couponAmount = 0;
    public $coupon_error = null;
    public $coupon_success = null;
    public $coupon_code;

    public function __construct() {
        $this->cart_handler = new CartManagerController();
        $this->shipping_price = 0;
    }
    public function render()
    {
        $this->carts = $this->cart_handler->get();
        $this->cart_product_ids = $this->cart_handler->get_product_ids();
        $this->CountCart();

        if($this->packaging_id != null && $this->packaging_id != 0) {
            $this->packaging_price = Packaging::where('id', $this->packaging_id)->first()->price;
        }

        if($this->card_id != null && $this->card_id != 0) {
            // dd($this->card_id);
            $this->card_price = Card::where('id', $this->card_id)->first()->price;
        }

        if($this->shipping_id != null && $this->shipping_id != 0) {
            $this->shipping_price = ShippingCharge::where('id', $this->shipping_id)->first()->shipping_charge;
        }

        $this->cart_total = $this->cart_handler->cart_total();

        $this->total_amount = $this->cart_total + $this->card_price + $this->packaging_price + $this->shipping_price;

        if($this->couponAmount) {
            $this->total_amount = $this->total_amount - $this->couponAmount;
        }


        $this->cards = Card::where('status', 1)->get();
        $this->packagings = Packaging::where('status', 1)->get();

        $product_id = [];
        foreach($this->carts as $cart){
            // dd($cart);
            array_push($product_id, $cart['product']['id'], $cart['product']['price']);
        }
        $shippings = ShippingCharge::join('product_shipping_charges','product_shipping_charges.shipping_charge_id','=','shipping_charges.id')
                ->whereIn('product_shipping_charges.product_id', $product_id)
                ->groupBy('shipping_charges.id')
                ->select('shipping_charges.*')
                ->get();
        if($shippings->count() > 0){
            $this->shippings = $shippings;
        }else{
            $this->shippings = ShippingCharge::where('status', 1)->get();
        }


        return view('livewire.frontend.checkout')->extends('layouts.app', [
            'meta' => [
                "title" =>  "Checkout | stygen",
                "image" => "",
                "og_image" => "",
                "twitter_image" => "",
                "description" => "",
                "price" => "" ,
                "keywords" => ""
            ],
        ]);
    }
    public function CountCart()
    {
        $this->cart_amount = $this->cart_handler->cart_count();
    }


    public function applyCoupon() {
        $coupon_code = $this->coupon_code;
	    $date = date("Y-m-d");
        $result = [];
        //if(Auth::check()){
           // $usesCount = Order::where('user_id', Auth::user()->id)->where('coupon_code', $coupon_code)->get()->count();
            $usesCount = Order::where('coupon_code', $coupon_code)->get()->count();
            $coupon = Coupon::where('code', $coupon_code)->where('status', 1)->first();
            $coupons = Coupon::where('status', 1)->get();


            //$checkCoupon = Coupon::where('code', $coupon_code)->where('status', 1)->where('use_limit', '>', $usesCount)->where('start_date','<=',$date)->where('expire_date','>=',$date)->first();
            $checkCoupon = Coupon::where('code', $coupon_code)->where('status', 1)->where('coupon_spent', 0)->where('start_date','<=',$date)->where('expire_date','>=',$date)->first();

            if(isset($coupon)){
                if(isset($checkCoupon)){
                    if(!empty($coupon->minimum_spent)){
                        $min_spent = $coupon->minimum_spent;
                    }else{
                        $min_spent = 0;
                    }

                    if(!empty($coupon->maximum_spent)){
                        $max_spent = $coupon->maximum_spent;
                    }else{
                        $max_spent = 0;
                    }

                    $cart_content = $this->carts;
                    $cart_count = $this->cart_handler->cart_count();

                    $discount = 0;
                    $vat      = 0;
                    foreach($cart_content as $cartInfo){
                        // dd($cartInfo);
                        $discount += $cartInfo['product']['regular_price'] - $cartInfo['product']['sales_price'];
                        $vat       += $cartInfo['product']['vat'];
                    }

                    // if($discount > 0){
                    //     $this->cart_total = $this->cart_total - $discount;
                    // }else{
                    //     $this->cart_total = $this->cart_total;
                    // }

                    if($vat > 0) {
                        $this->cart_total = $this->cart_total + $vat;
                    }

                    if ($checkCoupon->discount_type == 'Fixed'){
                        $this->couponAmount = number_format($checkCoupon->amount, 2);
                        $this->couponAmount = (int) $this->couponAmount;
                    }elseif($checkCoupon->discount_type == 'Percentage'){
                        $coupon_total = $this->cart_total * ($checkCoupon->amount / 100);
                        $this->couponAmount = number_format($coupon_total, 2);
                        $this->couponAmount = (int) $this->couponAmount;
                    }

                    if($min_spent > 0 && $min_spent < $this->cart_total && $max_spent == 0){
                        $result['coupon_amount'] = number_format($this->couponAmount, 2);
                        $coupon_amount = number_format($this->couponAmount, 2);
                        $this->total_amount = $this->total_amount - $coupon_amount;

                        $this->coupon_success = 'Your coupon applied';
                    }elseif($max_spent > 0 && $max_spent > $this->cart_total && $min_spent == 0){
                        $result['coupon_amount'] = number_format($this->couponAmount, 2);
                        $coupon_amount = number_format($this->couponAmount, 2);
                        $this->total_amount = $this->total_amount - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $this->coupon_success = 'Your coupon applied ';
                    }elseif(($min_spent > 0 && $min_spent < $this->cart_total) && ($max_spent > 0 && $max_spent < $this->cart_total)){
                        if ($checkCoupon->discount_type == 1){
                            $this->couponAmount = number_format($checkCoupon->amount, 2);
                        }elseif($checkCoupon->discount_type == 2){
                            $coupon_total = $max_spent * ($checkCoupon->amount / 100);
                            $this->couponAmount = number_format($coupon_total, 2);
                        }
                        $result['coupon_amount'] = number_format($this->couponAmount, 2);
                        $coupon_amount = number_format($this->couponAmount, 2);
                        $this->total_amount = $this->total_amount - $coupon_amount;
                        // dd($this->total_amount);
                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $this->coupon_success = 'Your coupon applied.';
                    }elseif(($min_spent > 0 && $min_spent < $this->cart_total) && ($max_spent > 0 && $max_spent > $this->cart_total)){

                        if ($checkCoupon->discount_type == 1){
                            $this->couponAmount = number_format($checkCoupon->amount, 2);
                        }elseif($checkCoupon->discount_type == 2){
                            $coupon_total = $max_spent * ($checkCoupon->amount / 100);
                            $this->couponAmount = number_format($coupon_total, 2);
                        }
                        $result['coupon_amount'] = number_format($this->couponAmount, 2);
                        $coupon_amount = number_format($this->couponAmount, 2);
                        $this->total_amount = $this->total_amount - $coupon_amount;
                        // dd($this->total_amount);
                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $this->coupon_success = 'Your coupon applied.';
                    }
                    elseif($min_spent == 0 && $max_spent == 0){
                        $result['coupon_amount'] = number_format($this->couponAmount, 2);
                        $coupon_amount = number_format($this->couponAmount, 2);
                        $this->total_amount = $this->total_amount - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $this->coupon_success = 'Your coupon applied.';
                    }
                    else{
                       // $result['error'] = 'Your Coupon Code or Limit has Expired';
                        $this->coupon_error = 'Your coupon expired.';

                    }
                }else{
                   // $result['error'] = 'Your Coupon Code has Expired';
                    $this->coupon_error = 'Your coupon expired.';
                }
            }else{
                //$result['error'] = 'Coupon Code is Invalid';
                $this->coupon_error = "This coupon doesn't exist.";
            }

            $this->render();
            // dd($this->coupon_error);
            // dd($this->coupon_success);
    }
}
