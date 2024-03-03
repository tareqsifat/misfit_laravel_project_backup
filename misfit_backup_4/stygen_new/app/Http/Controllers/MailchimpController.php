<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Helper;
use Illuminate\Http\Request;

class MailchimpController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new \MailchimpMarketing\ApiClient();

        $this->client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20',
        ]);
    }

    public function addstore() {
        $response = $this->client->ecommerce->addStore([
            "id" => "stygen",
            "list_id" => "3484b264b0",
            "name" => "Stygen",
            "currency_code" => "BDT",
            "platform" => "custom site",
            "is_syning" => true,
            "email_address" => "sajid.stygen@gmail.com",
            "money_format" => "৳",
            "phone" => "01971971520",
            "address" => [
                "address1" => "House: 65, Level-2, Road: 03, Block: B",
                "address2" => "Niketon, Gulshan-1, Dhaka",
                "city" => "Dhaka",
                "country_code" => "BD",
                "country" => "Bangladesh"
            ]
        ]);
        ddd($response);
    }

    public function addproducts() {
        $products = Product::select('id','category_id','product_name', 'pro_slug', 'featured_image', 'short_description','regular_price', 'sales_price','product_sku')
        ->where('status', 1)->orderBy('id', 'DESC')->get();


        $product_variants = ProductVariation::select('color','size')->distinct('color', 'size')->get();

        foreach($products as $product) {
            $category = ProductCategory::join('categories','categories.id','=','product_categories.category_id')
                    ->where('product_categories.product_id', $product->id)
                    ->where('categories.status', 1)
                    ->select('categories.category_name')->first();

            if(isset($category)){
                $category_name = $category->category_name;
            }else{
                $category_name = 'Uncategorized';
            }

            if(isset($product->short_description)){
                $description = $product->short_description;
            }else{
                $description = 'Description not found for this product';
            }

            if(isset($product->featured_image)){
                $imgae = $product->featured_image;
            }else{
                $image = 'https://www.stygen.gift/assets/uploads/product/empty_product.jpeg';
            }
            $product_quantity = Helper::productStock($product->id);

            if(isset($product_quantity)){
                $quantity = $product_quantity;
            }else{
                $quantity = 0;
            }

            // $product_id = $product->product_sku;
            $product_price = (int)$product->regular_price;

            $pro_id = 'stg_' . $product->id;
            $cat_id = 'cat_' . $category->id;

            try {
                $response = $this->client->ecommerce->addStoreProduct("stygen", [
                    "id" => "$pro_id",
                    "title" => $product->product_name,
                    "url" => "https://www.stygen.gift/product/" . $product->pro_slug,
                    "description" => $description,
                    "type" => $category_name,
                    "image_url" => "https://www.stygen.gift/assets/uploads/product/" . $imgae,
                    "variants" => [
                        [
                            "id" => $cat_id,
                            "title" => $category_name,
                            "price" => $product_price,
                            "inventory_quantity" => $quantity
                        ]
                    ],
                ]);
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                ddd($e->getResponse()->getBody()->getContents());
            }
        }

        ddd($response);
    }

    public function products() {
        try {
            $response = $this->client->ecommerce->getAllStoreProducts("stygen");
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            ddd($e->getResponse()->getBody()->getContents());
        }
        // $response = $client->ecommerce->deleteStoreProduct("stygen", "stg_udNq9RZb");
        ddd($response);
    }

    public function delete_products() {
        $response = $this->client->ecommerce->getAllStoreProducts("stygen");
        $products = $response->products;
        if(isset($products)) {
            foreach($products as $product) {
                try {
                    $newresponse = $this->client->ecommerce->deleteStoreProduct("stygen", $product->id);
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    ddd($e->getResponse()->getBody()->getContents());
                }
                // dd($response);
            }
        }
        else {
            echo 'all deleted';
        }
        ddd($newresponse);
    }

    public function customer() {
        try {
            $response = $this->client->ecommerce->getAllStoreCustomers("stygen");
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            ddd($e->getResponse()->getBody()->getContents());
        }
        ddd($response);
    }

    public function sublist() {
        $response = $this->client->lists->getAllLists();
        try {
            $response = $this->client->lists->getAllLists();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            ddd($e->getResponse()->getBody()->getContents());
        }
        ddd($response);
    }
}
