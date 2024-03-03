<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Addon_product;
use App\Models\Product;
use App\Models\ProductVariation;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $color = $request->color;
        $size = $request->size;
        $weight = $request->weight;

        if(!empty($color) && !empty($size) && !empty($weight)) {
            $variation_id = ProductVariation::where('product_id', $request->product['id'])->where('color', $color)->where('size', $size)->where('weight', $weight)->where('status', 1)->first();
            if(isset($variation_id)){
                $variation_id = $variation_id->id;
                $cart_msg = 1;
            }else{
                $variation_id = NULL;
                $cart_msg = 'error';
            }
        }
        else if(!empty($color) && !empty($size)) {
            $variation_id = ProductVariation::where('product_id', $request->product['id'])->where('color', $color)->where('size', $size)->where('status', 1)->first();
            if(isset($variation_id)){
                $variation_id = $variation_id->id;
                $cart_msg = 1;
            }else{
                $variation_id = NULL;
                $cart_msg = 'error';
            }
        }
        else if(!empty($color) && !empty($weight)) {
            $variation_id = ProductVariation::where('product_id', $request->product['id'])->where('color', $color)->where('weight', $weight)->where('status', 1)->first();
            if(isset($variation_id)){
                $variation_id = $variation_id->id;
                $cart_msg = 1;
            }else{
                $variation_id = NULL;
                $cart_msg = 'error';
            }
        }
        else if(!empty($size) && !empty($weight)) {
            $variation_id = ProductVariation::where('product_id', $request->product['id'])->where('size', $size)->where('weight', $weight)->where('status', 1)->first();
            if(isset($variation_id)){
                $variation_id = $variation_id->id;
                $cart_msg = 1;
            }else{
                $variation_id = NULL;
                $cart_msg = 'error';
            }
        }
        else {
            if(isset($request->product['id'])){
                $productStock = Helper::productStock($request->product['id']);
                if(!empty($productStock)){
                    $variation_id = NULL;
                    $cart_msg = 1;
                }else{
                    $variation_id = NULL;
                    $cart_msg = 'error';
                }
            }
        }
        if($cart_msg == 1){
            $productInfo = Product::find($request->product['id']);

            if($productInfo->sales_price != null) {
                $product_price = $productInfo->sales_price;
            }
            else {
                $product_price = $productInfo->regular_price;
            }

            $discount_amount = 0;
            $total_vat = 0;
            if(!empty($productInfo)){
                if(!empty($productInfo->sales_price)){
                    $discount_amount = ($productInfo->regular_price) - ($productInfo->sales_price);
                }else{
                    $discount_amount = 0;
                }

                if(!empty($productInfo->vat)){
                    $total_vat = ceil(($productInfo->regular_price) * (($productInfo->vat) / 100));
                }else{
                    $total_vat = 0;
                }
            }
            $cart = \Cart::add([
                [
                    'id'        => $request->product['id'],
                    'name'      => $request->product['product_name'],
                    'price'     => $product_price,
                    'quantity'  => (!empty($request->qty))?$request->qty:1,
                    'attributes'=> [
                        'image'         => $request->product['featured_image'],
                        'color'         => (!empty($color))?$color:NULL,
                        'size'          => (!empty($size))?$size:NULL,
                        'weight'        => (!empty($weight))?$weight:NULL,
                        'variation_id'  => $variation_id,
                        'discount_price'=> $discount_amount,
                        'vat'           => $total_vat,
                    ]
                ]

            ]);


            return \Cart::getContent();
        }else{
            return response()->json($cart_msg);
        }
    }

    public function cartProductList() {
        $cart_content = \Cart::getContent();
        $cart_count = $cart_content->count();

        $discount = 0;
        $vat      = 0;
        $sku      = [];
        $product_id = [];
        $addon_products = Addon_product::whereIN('product_id',$sku)
            ->where('addon_products','!=','')
            ->with([
                    'product'=>function($query){
                        $query->where('status',1)
                            ->select([
                                'id',
                                'product_name',
                                'featured_image',
                                'regular_price',
                                'sales_price',
                                'product_sku',
                                'pro_slug',
                                'short_description'
                            ]);
                    }
                ])
            ->get();
            // dd($cart_content);
        foreach($cart_content as $cartInfo){
            $discount  += $cartInfo->attributes['discount_price'];
            $vat       += $cartInfo->attributes['vat'];
            $productInfo = Product::where('id', $cartInfo->id)->select('id','product_sku')->first();
            if(isset($productInfo)){
                $pro_sku = Str::slug($productInfo->product_sku);
                $productSku = $productInfo->id;
                array_push($sku, $productSku);
            }
        }

        // if($discount > 0){
        //     $cartTotal = \Cart::getTotal() - $discount;
        // }else{
            $cartTotal = \Cart::getTotal();
        // }

        return response()->json([
            'products'     => \Cart::getContent(),
            'sub_total'    => \Cart::getTotal(),
            'total'        => $cartTotal + $vat,
            'total_qty'    => \Cart::getTotalQuantity(),
            'cart_count'   => $cart_count,
            'discount'     => $discount,
            'vat'          => $vat,
            'sku'          => $sku,
            'addon_products' => $addon_products
        ], 200);
    }

    public function removeCartProduct($id) {
        \Cart::remove($id);
    }
    public function updateCart(Request $request) {
        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));
    }
}
