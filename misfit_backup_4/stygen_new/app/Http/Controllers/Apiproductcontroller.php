<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products as ResourceProduct;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class Apiproductcontroller extends Controller
{
    public function index () {
        // $products = Product::orderBy('created_at','desc');
        return new ResourceProduct(Product::all());
    }

    public function sendCoupon($coupon_amount, $coupon_value, Request $request, Coupon $coupon) {
        $coupon_amount = $request->coupon_amount;
        $coupon_value = $request->coupon_value;

        // if(isset($coupon_amount)) {
        //     $code = 'Stg'. Str::random(5);
        //     while($coupon_amount >= $request->coupon_amount) {
        //         Coupon::create('coupon' => $code)
        //     }
        // }

        if($request->coupon_amount > 0) {
            do {
                $codes = [];

                for ($i = 0; $i < $request->coupon_amount; $i++) {
                    $codes[] = 'Xtra'.(string)mt_rand(pow(10, 10), pow(10, 11) - 1);
                }
            }
            while(!$request->coupon_amount);
        }
        foreach ($codes as $code) {
            $coupon->create([
                'code' => $code,
                'amount' => $coupon_value
            ]);
        }
        return response()->json([
            'codes' => $codes,
            'amount' => $coupon_value,
            'Coupon created successfully.'
        ], 200);
    }
}
