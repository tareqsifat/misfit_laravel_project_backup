<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
class ThankYou extends Component
{
    public $total_amount;
    public $skus=[];
    public $productInfos=[];

    public function mount($order_id)
    {
        $orderInfo = Order::where('id', $order_id)->select('total_amount')->first();
        if(isset($orderInfo)){
            $this->total_amount = $orderInfo->total_amount;
        }else{
            $this->total_amount = 0;
        }
        $product_ids = OrderDetail::where('order_id', $order_id)->get()->pluck('product_id');
        // $sku = [];
        $productInfos = [];

        foreach($product_ids as $product_id){
            $productInfo = Product::where('id', $product_id)->select('id','product_sku','product_name','regular_price')->first();

            array_push($this->skus, $productInfo->id);
            array_push($this->productInfos, $productInfo);
        }
    }
    public function render()
    {
        return view('livewire.frontend.thank-you')->extends('layouts.app');
    }
}
