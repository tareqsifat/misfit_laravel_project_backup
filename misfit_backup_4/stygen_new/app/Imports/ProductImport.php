<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\StockLedger;
use DateTime;
use Helper;
use Illuminate\Support\Facades\DB;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $companyId           = Auth::guard('seller')->user()->company_id;
        $userId              = Auth::guard('seller')->user()->id;
        $category_name       = $row['category_name'];
        $brand_name          = $row['brand_name'];
        $product_name        = $row['product_name'];
        $product_sku         = $row['product_sku'];
        $short_description   = $row['long_description'];
        $long_description    = $row['product_name'];
        $vat                 = $row['vat'];
        $regular_price       = $row['regular_price'];
        $sale_price          = $row['sale_price'];
        $quantity            = $row['quantity'];
        $youtube_link        = $row['youtube_link'];

        $model               = DB::table('stock_ledgers');
        $ledgerType          = 4;
        $invoice_no          = Helper::autoInvoiceNoGenereate($model, $ledgerType);
        $current_date        = date('d/m/Y');
        $invoice_date        = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');

        $brand = Brand::where('brand_name', $brand_name)->where('company_id', $companyId)->where('status', 1)->first();
        if(isset($brand)){
            $brand_id = $brand->id;
        }else{
            $brand = Brand::create([
                'company_id'            => $companyId,
                'brand_name'            => $brand_name,
                'brand_website'         => NULL,
                'brand_slug'            => Str::slug($brand_name),
                'brand_description'     => NULL,
                'status'                => 1,
                'created_by'            => $userId
            ]);
            $brand_id = $brand->id;
        }

        $category = Category::where('category_name', $category_name)->where('status', 1)->first();
        $category_ids = [];
        if(isset($category)){
            $category_id = $category->id;
            array_push($category_ids, $category_id);
        }else{
            $category = Category::create([
                'company_id'            => 0,
                'parent_id'             => 0,
                'label'                 => 0,
                'category_name'         => $category_name,
                'cat_slug'              => Str::slug($category_name),
                'category_description'  => NULL,
                'status'                => 1,
                'created_by'            => 0
            ]);
            $category_id = $category->id;
            array_push($category_ids, $category_id);
        }

        $existing_sku = Product::where('company_id', $companyId)->where('status', 1)->where('product_sku', $product_sku)->first();
        if(isset($existing_sku)){
            return $existing_sku;
        }else{
            $product = Product::create([
                'company_id'             => $companyId,
                'category_id'            => $category_ids,
                'brand_id'               => $brand_id,
                'product_name'           => $product_name,
                'pro_slug'               => Str::slug($product_name),
                'product_sku'            => $product_sku,
                'short_description'      => $short_description,
                'long_description'       => $long_description,
                'regular_price'          => (!empty($regular_price))?$regular_price:0,
                'sales_price'            => (!empty($sale_price))?$sale_price:NULL,
                'quantity'               => $quantity,
                'youtube_link'           => (!empty($youtube_link))?$youtube_link:NULL,
                'vat'                    => (!empty($vat))?$vat:NULL,
                'shipping_charge_id'     => NULL,
                'occasion_id'            => NULL,
                'recipient_id'           => NULL,
                'featured_image'         => '',
                'discount_status'        => (!empty($sale_price))? 1: 0,
                'status'                 => 1,
                'created_by'             => $userId,
            ]);

            ProductCategory::create([
                'company_id'        => $product->company_id,
                'product_id'        => $product->id,
                'category_id'       => $category_id,
                'status'            => 1,
            ]);

            StockLedger::create([
                'company_id'  => $product->company_id,
                'invoice_no'  => $invoice_no,
                'invoice_date'=> $invoice_date,
                'product_id'  => $product->id,
                'variation_id'=> NULL,
                'stock_in'    => $product->quantity,
                'stock_out'   => 0,
                'ledger_type' => 4,
                'status'      => 1,
                'created_by'  => $userId
            ]);

            return $product;
        }
    }
}
