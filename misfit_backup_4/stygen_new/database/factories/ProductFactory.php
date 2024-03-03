<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id'        => function(){
                return Company::all()->random();
            },
            'category_id'       => function(){
                return Category::all()->random();
            },
            'brand_id'          => function(){
                return Brand::all()->random();
            },
            'product_name'      => $this->faker->name,
            'pro_slug'          => Str::slug($this->faker->name),
            'product_sku'       => $this->faker->ean8,
            'short_description' => $this->faker->text,
            'long_description'  => $this->faker->text,
            'vat'    => function(){
                return rand(10, 100);
            },
            'shipping_charge_id' => Str::random(5),
            'occasion_id' => Str::random(13),
            'recipient_id' => Str::random(13),
            'featured_image' => 'default.png',
            'regular_price'       => function(){
                return rand(200, 20000);
            },
            'sales_price'       => function(){
                return rand(200, 500);
            },
            'quantity'          => function(){
                return rand(10, 100);
            },
            'discount_status'   => 1,
            'add_on'   => 0,
            'occasion_visibility'   => 1,
            'product_view'     => Str::random(500),
            'total_ratting' => Str::random(500),
            'status'            => 1,
        ];
    }
}
