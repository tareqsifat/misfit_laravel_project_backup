<?php

namespace Database\Seeders;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductStockLog;
use App\Models\Product\ProductSupplier;
use App\Models\ProductDiscount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        ProductStock::truncate();
        ProductStockLog::truncate();
        ProductDiscount::truncate();

        // product 1
        $product = new Product();
        $product->title = "SSC Note English 1st paper";
        $product->price = 150;
        $product->image = "test/english.jpeg";
        $product->save();

        $product_discount = new ProductDiscount();
        $product_discount->product_id = 1;
        $product_discount->discount_type = 'flat';
        $product_discount->amount = 10;
        $product_discount->last_date = Carbon::now()->addYear(1)->toDateTimeString();
        $product_discount->save();

        $product_stock = new ProductStock();
        $product_stock->product_id = $product->id;
        $product_stock->qty = 10;
        $product_stock->date = Carbon::now()->toDateString();
        $product_stock->supplier_id = 1;
        $product_stock->save();

        $product_stock_log = new ProductStockLog();
        $product_stock_log->product_id = $product->id;
        $product_stock_log->qty = 10;
        $product_stock_log->type = "initial";
        $product_stock_log->date = Carbon::now()->toDateString();
        $product_stock_log->creator = 1;
        $product_stock_log->save();

        // product 2
        $product2 = new Product();
        $product2->title = "HSC math note book";
        $product2->price = 150;
        $product2->image = "test/math.jpg";
        $product2->save();

        $product_discount = new ProductDiscount();
        $product_discount->product_id = 2;
        $product_discount->discount_type = 'percent';
        $product_discount->discount_percent = 5;
        $product_discount->amount = 7;
        $product_discount->last_date = Carbon::now()->addYear(1)->toDateTimeString();
        $product_discount->save();

        $product_stock = new ProductStock();
        $product_stock->product_id = $product2->id;
        $product_stock->qty = 12;
        $product_stock->date = Carbon::now()->toDateString();
        $product_stock->supplier_id = 2;
        $product_stock->save();

        $product_stock_log = new ProductStockLog();
        $product_stock_log->product_id = $product2->id;
        $product_stock_log->qty = $product_stock->qty;
        $product_stock_log->type = "initial";
        $product_stock_log->date = Carbon::now()->toDateString();
        $product_stock_log->creator = 1;
        $product_stock_log->save();

        // product 3
        $product3 = new Product();
        $product3->title = "HSC Chemistry note book";
        $product3->price = 150;
        $product3->image = "test/chemistry.png";
        $product3->save();

        $product_discount = new ProductDiscount();
        $product_discount->product_id = 3;
        $product_discount->discount_type = 'percent';
        $product_discount->discount_percent = 2;
        $product_discount->amount = 3;
        $product_discount->last_date = Carbon::now()->addYear(1)->toDateTimeString();
        $product_discount->save();

        $product_stock = new ProductStock();
        $product_stock->product_id = $product3->id;
        $product_stock->qty = 5;
        $product_stock->date = Carbon::now()->toDateString();
        $product_stock->supplier_id = 2;
        $product_stock->save();

        $product_stock_log = new ProductStockLog();
        $product_stock_log->product_id = $product3->id;
        $product_stock_log->qty = $product_stock->qty;
        $product_stock_log->type = "initial";
        $product_stock_log->date = Carbon::now()->toDateString();
        $product_stock_log->creator = 1;
        $product_stock_log->save();

        $this->call([
            ProductSupplierSeeder::class,
            ProductOrderSeeder::class,
        ]);
    }
}
