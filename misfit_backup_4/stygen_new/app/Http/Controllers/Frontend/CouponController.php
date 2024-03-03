<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply_coupon(Request $request) {
        $coupon_code = $request->coupon_code;
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

                    $cart_content = \Cart::getContent();
                    $cart_count = $cart_content->count();

                    $discount = 0;
                    $vat      = 0;
                    foreach($cart_content as $cartInfo){
                        $discount  += $cartInfo->attributes['discount_price'];
                        $vat       += $cartInfo->attributes['vat'];
                    }

                    if($discount > 0){
                        $cartTotal = \Cart::getTotal() - $discount;
                    }else{
                        $cartTotal = \Cart::getTotal();
                    }

                    if($vat > 0) {
                        $cartTotal = $cartTotal + $vat;
                    }

                    if ($checkCoupon->discount_type == 'Fixed'){
                        $couponAmount = number_format($checkCoupon->amount, 2);
                    }elseif($checkCoupon->discount_type == 'Percentage'){
                        $coupon_total = $cartTotal * ($checkCoupon->amount / 100);
                        $couponAmount = number_format($coupon_total, 2);
                    }

                    if($min_spent > 0 && $min_spent < $cartTotal && $max_spent == 0){
                        $result['coupon_amount'] = number_format($couponAmount, 2);
                        $coupon_amount = number_format($couponAmount, 2);
                        $result['total_amount'] = $cartTotal - $coupon_amount;
                        // $result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;

                        $success = 'Your coupon applied';
                    }elseif($max_spent > 0 && $max_spent > $cartTotal && $min_spent == 0){
                        $result['coupon_amount'] = number_format($couponAmount, 2);
                        $coupon_amount = number_format($couponAmount, 2);
                        $result['total_amount'] = $cartTotal - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $success = 'Your coupon applied ';
                    }elseif(($min_spent > 0 && $min_spent < $cartTotal) && ($max_spent > 0 && $max_spent < $cartTotal)){
                        if ($checkCoupon->discount_type == 1){
                            $couponAmount = number_format($checkCoupon->amount, 2);
                        }elseif($checkCoupon->discount_type == 2){
                            $coupon_total = $max_spent * ($checkCoupon->amount / 100);
                            $couponAmount = number_format($coupon_total, 2);
                        }
                        $result['coupon_amount'] = number_format($couponAmount, 2);
                        $coupon_amount = number_format($couponAmount, 2);
                        $result['total_amount'] = $cartTotal - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $success = 'Your coupon applied.';
                    }elseif(($min_spent > 0 && $min_spent < $cartTotal) && ($max_spent > 0 && $max_spent > $cartTotal)){
                        if ($checkCoupon->discount_type == 1){
                            $couponAmount = number_format($checkCoupon->amount, 2);
                        }elseif($checkCoupon->discount_type == 2){
                            $coupon_total = $max_spent * ($checkCoupon->amount / 100);
                            $couponAmount = number_format($coupon_total, 2);
                        }
                        $result['coupon_amount'] = number_format($couponAmount, 2);
                        $coupon_amount = number_format($couponAmount, 2);
                        $result['total_amount'] = $cartTotal - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $success = 'Your coupon applied.';
                    }
                    elseif($min_spent == 0 && $max_spent == 0){
                        $result['coupon_amount'] = number_format($couponAmount, 2);
                        $coupon_amount = number_format($couponAmount, 2);
                        $result['total_amount'] = $cartTotal - $coupon_amount;

                        //$result['msg'] = 'Your Coupon Bonus is '.$coupon_amount;
                        $success = 'Your coupon applied.';
                    }
                    else{
                       // $result['error'] = 'Your Coupon Code or Limit has Expired';
                        $error = 'Your coupon expired.';
                    }
                }else{
                   // $result['error'] = 'Your Coupon Code has Expired';
                    $error = 'Your coupon expired.';
                }
            }else{
                //$result['error'] = 'Coupon Code is Invalid';
                $error = "This coupon doesn't exist.";
            }
        // }else{
        //     $result['error'] = 'Please login first for applying coupon';
        // }

	    return response()->json([
            'error'         =>  (!empty($error))?$error:'',
            'success'       =>  (!empty($success))?$success:'',
            'coupon_amount' =>  (!empty($coupon_amount))?(int)$coupon_amount:0,
            'total_amount'  =>  (!empty($result['total_amount']))?$result['total_amount']:0,
        ], 200);
    }
}
