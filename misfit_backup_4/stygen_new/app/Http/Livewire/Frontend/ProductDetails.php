<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Livewire\Component;
class ProductDetails extends Component
{
    public $product_details;
    public $related_products;
    public $all_attributes;

    public function mount($slug)
    {
        $query = Product::where('pro_slug',$slug)->with(['brand','product_categories','product_images','product_variations','reviews']);
        $query->withSum(['purchase_stock' => function ($q) {
            $q->where('type', 'purchase');
        }], 'qty');

        $query->withSum(['sell_stock' => function ($q) {
            $q->where('type', 'sell');
        }], 'qty');

        $this->product_details = $query->first();
        if(!$this->product_details) {
            abort(404, "No product found with this link");
        }
        $color_count = 0;
        $size_count = 0;
        $weight_count = 0;


        // dd($addon_products);

        if(!empty($this->product_details->product_variations)) {
            $color = [];
            $size = [];
            $weight = [];
            $colors = ProductVariation::where('product_id', $this->product_details->id)->where('color', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['color','color_code']);
            $sizes = ProductVariation::where('product_id', $this->product_details->id)->where('size', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['size']);
            $weights = ProductVariation::where('product_id', $this->product_details->id)->where('weight', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['weight']);
            foreach($this->product_details->product_variations as $product_variation) {
                if(!empty($product_variation->color)) {
                    array_push($color, $product_variation->color);
                }
                if(!empty($product_variation->size)) {
                    array_push($size, $product_variation->size);
                }
                if(!empty($product_variation->weight)) {
                    array_push($weight, $product_variation->weight);
                }
            }
            $color_count = count($color);
            $size_count = count($size);
            $weight_count = count($weight);
        }
        $this->all_attributes = [
            'color_count'   => $color_count,
            'size_count'    => $size_count,
            'weight_count'  => $weight_count,
            'colors'        => $colors,
            'sizes'         => $sizes,
            'weights'       => $weights
        ];

        $product = Product::where('pro_slug', $slug)->select('id')->first();
        $related_product_ids = [];

        // Get Product by Category
        $category = ProductCategory::where('product_id', $product->id)->get()->pluck('category_id');
        if(!empty($category)) {
            $parent_category = Category::where('parent_id', 0)->whereIn('id', $category)->get();
            if($parent_category->count() > 0) {
                $parent_category = $parent_category->pluck('id');
            } else {
                $parent_category = Category::whereIn('id', $category)->get()->pluck('parent_id');
            }
            $product_ids = ProductCategory::where('category_id', $parent_category)->distinct()->pluck('product_id');

            if(count($related_product_ids) == 2) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    if($relatedProduct->count() > 2){
                        $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(2);
                    }else{
                        $rand_id = $relatedProduct->count();
                        $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

            if(count($related_product_ids) == 1) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    $rand_id = $relatedProduct->count();
                    if($rand_id > 0) {
                        if($rand_id > 2) {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(3);
                        } else {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                        }
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

            if(count($related_product_ids) == 0) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    $rand_id = $relatedProduct->count();
                    if($rand_id > 0) {
                        if($rand_id > 3) {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(4);
                        } else {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                        }
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

        }

        $this->related_products = Product::whereIn('id', $related_product_ids)->where('id', '!=', $product->id)->with('brand','product_categories','product_images','product_variations','reviews')->get();
    }
    public function render()
    {

        return view('livewire.frontend.product-details')->extends('layouts.app', [
            'meta' => [
                "title" =>  $this->product_details->product_name . " | stygen",
                "image" => "",
                "og_image" => "",
                "twitter_image" => "",
                "description" => "",
                "price" => "" ,
                "keywords" => ""
            ],
        ]);
    }
}
