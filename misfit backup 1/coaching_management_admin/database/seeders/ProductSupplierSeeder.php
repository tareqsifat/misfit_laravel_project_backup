<?php

namespace Database\Seeders;

use App\Models\Product\ProductSupplier;
use Illuminate\Database\Seeder;

class ProductSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSupplier::truncate();
        $product_supply = new ProductSupplier();
        $product_supply->full_name = "omuk prokashoni";
        $product_supply->contact_number = "0179874856";
        $product_supply->address = "31/A, road 4, Banglamotor, Dhaka";
        $product_supply->save();

        $product_supply2 = new ProductSupplier();
        $product_supply2->full_name = "tomuk prokashoni";
        $product_supply2->contact_number = "0179874855";
        $product_supply2->address = "41/A, road 4, Banglamotor, Dhaka";
        $product_supply2->save();


        $product_supply3 = new ProductSupplier();
        $product_supply3->full_name = "Kono Ek prokashoni";
        $product_supply3->contact_number = "0179874853";
        $product_supply3->address = "51/A, road 4, Banglamotor, Dhaka";
        $product_supply3->save();
    }
}
