<?php

namespace Database\Seeders;

use App\Models\Order\ProductOrder;
use App\Models\Order\ProductOrderDetail;
use Illuminate\Database\Seeder;

class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductOrder::truncate();
        ProductOrderDetail::truncate();

        // Order 1
        $product_order = new ProductOrder();
        $product_order->invoice_id = uniqid();
        $product_order->user_id = 3;
        $product_order->total_amount = 740;
        $product_order->paid_amount = 740;
        $product_order->status = "pending";
        $product_order->payment_status = "pending";
        $product_order->save();

        $product_order_detail = new ProductOrderDetail();
        $product_order_detail->product_id = 1;
        $product_order_detail->order_id = $product_order->id;
        $product_order_detail->qty = 5;
        $product_order_detail->price = 150;
        $product_order_detail->discount = 0;
        $product_order_detail->total = 750;
        $product_order_detail->save();

        // end of order1


        // start of order 2
        $product_order2 = new ProductOrder();
        $product_order2->invoice_id = uniqid();
        $product_order2->user_id = 3;
        $product_order2->total_amount = 1030;
        $product_order2->paid_amount = 1030;
        $product_order2->status = "pending";
        $product_order2->payment_status = "pending";
        $product_order2->save();

        $product_order_detail2 = new ProductOrderDetail();
        $product_order_detail2->product_id = 2;
        $product_order_detail2->order_id = $product_order2->id;
        $product_order_detail2->qty = 7;
        $product_order_detail2->price = 150;
        $product_order_detail2->discount = 0;
        $product_order_detail2->total = 1050;
        $product_order_detail2->save();

        // end of order 2

        // start of order 3
        $product_order3 = new ProductOrder();
        $product_order3->invoice_id = uniqid();
        $product_order3->user_id = 3;
        $product_order3->total_amount = 450;
        $product_order3->paid_amount = 450;
        $product_order3->status = "pending";
        $product_order3->payment_status = "pending";
        $product_order3->save();

        $product_order_detail3 = new ProductOrderDetail();
        $product_order_detail3->product_id = 3;
        $product_order_detail3->order_id = $product_order3->id;
        $product_order_detail3->qty = 4;
        $product_order_detail3->price = 150;
        $product_order_detail3->discount = 0;
        $product_order_detail3->total = 450;
        $product_order_detail3->save();

        // end of order 3

        // start of order 4
        $product_order4 = new ProductOrder();
        $product_order4->invoice_id = uniqid();
        $product_order4->user_id = 3;
        $product_order4->total_amount = 1500;
        $product_order4->paid_amount = 1500;
        $product_order4->status = "pending";
        $product_order4->payment_status = "pending";
        $product_order4->save();

        $product_order_detail4 = new ProductOrderDetail();
        $product_order_detail4->product_id = 1;
        $product_order_detail4->order_id = $product_order4->id;
        $product_order_detail4->qty = 5;
        $product_order_detail4->price = 150;
        $product_order_detail4->discount = 0;
        $product_order_detail4->total = 750;
        $product_order_detail4->save();

        $product_order_detail4 = new ProductOrderDetail();
        $product_order_detail4->product_id = 3;
        $product_order_detail4->order_id = $product_order4->id;
        $product_order_detail4->qty = 5;
        $product_order_detail4->price = 150;
        $product_order_detail4->discount = 0;
        $product_order_detail4->total = 750;
        $product_order_detail4->save();
        
    }
}
