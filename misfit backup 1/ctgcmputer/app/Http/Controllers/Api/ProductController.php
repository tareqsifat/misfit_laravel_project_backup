<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product\ProductVariant;
use App\Models\Tag;
use App\Models\WebsiteUrl;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function top_products()
    {
        $page = request()->page ?? 1;
        $get_json = request()->get_json;
        $take = request()->take ?? 20;
        $skip = ($page - 1) * $take;

        $products = Product::take($take)
            ->with('discounts', function ($q) {
                $q->orderBy('created_at', 'DESC')->where('discount_last_date', '>', Carbon::now())
                    ->select('id', 'product_id', 'discount_percent', 'discount_amount', 'discount_last_date');
            })
            ->select([
                'products.id',
                'product_name',
                'is_top_product',
                'product_url',
                'brand_id',
                'selected_categories',
                'short_description',
                'cost',
                'sales_price',
                'call_for_price',
                'is_upcomming',
                'is_tba',
                'is_pre_order',
                'is_in_stock',
                'low_stock',
                'stock',
            ])
            ->with(['product_brand'])
            ->withSum('stocks', 'qty')
            ->withSum('sales', 'qty')
            ->skip($skip)
            ->orderBy('is_top_product', 'DESC')
            ->where('is_in_stock', 1)
            ->where('sales_price', '>', 0)
            ->get();

        if ($get_json) {
            return response()->json([
                "data" => $products
            ]);
        } else {
            $product_html = "";
            foreach ($products as $product) {
                $product_html .= view('website.include.product', compact('product'))->render();
            }
            return response()->json([
                "data" => $product_html,
            ]);
        }
    }

    public function category_products($category_id, $category_name)
    {
        $category = null;
        $products = null;

        $min = request()->min && is_numeric(request()->min) ? request()->min : 0;
        $max = request()->max && is_numeric(request()->max) ? request()->max : 500000;
        $query_brands = request()->brands ? request()->brands : null;
        $query_availability = request()->availability ? request()->availability : null;

        $min_product_price = Product::orderBy('sales_price', 'ASC')->first();
        $max_product_price = Product::orderBy('sales_price', 'DESC')->first();

        $products = [];
        $links = '';
        $api_links = '';
        $api_pagination = '';

        if ($min_product_price) {
            $min_product_price = $min_product_price->sales_price;
            $max_product_price = $max_product_price->sales_price;

            if (Category::where('id', $category_id)->exists()) {
                $category = Category::where('id', $category_id)->first();

                $data_query = $category->products()
                    ->whereBetween('products.sales_price', [$min, $max])
                    ->where('status', 1)
                    ->where('products.sales_price', '>', 0);

                if ($query_brands) {
                    $data_query->whereIn('brand_id', $query_brands);
                }

                if ($query_availability) {
                    $data_query->where($query_availability, 1);
                }

                $data_query->orderBy('is_top_product', 'DESC')
                    ->select([
                        'products.id',
                        'product_name',
                        'is_top_product',
                        'product_url',
                        'brand_id',
                        'selected_categories',
                        'short_description',
                        'cost',
                        'sales_price',
                        'call_for_price',
                        'is_upcomming',
                        'is_tba',
                        'is_pre_order',
                        'is_in_stock',
                        'low_stock',
                        'stock',
                    ])
                    // ->withSum('stocks','qty')
                    // ->withSum('sales','qty')
                ;

                $total = $data_query->count();
                $page = request()->page ?? 1;
                $perpage = request()->perpage ?? 28;
                $skip = ($page - 1) * $perpage;
                $items = $data_query->skip($skip)->take($perpage)->get();
                $data = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url("/category/$category_id/" . $category->name)]);
                $api_links = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url("/api/v1/category/$category_id/" . $category->name)]);
                $api_pagination = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url("/api/v1/category/$category_id/" . $category->name)]);


                $products = $data->items();
                if ($min >= 0) {
                    $data->appends('min', $min);
                }
                if ($max >= 0) {
                    $data->appends('max', $max);
                }
                if ($query_brands) {
                    $data->appends('brands', $query_brands);
                }
                $links = $data->links()->render();
                $api_links = $api_links->links()->render();
            }
        }

        $product_html = "";
        foreach ($products as $product) {
            $product_html .= view('website.include.product', compact('product'))->render();
        }
        return response()->json([
            'products' => $product_html ? $product_html : 'there is no product found.',
            'links' => $links,
            'api_links' => $api_links,
            'api_pagination' => $api_pagination,
        ]);
    }

    public function category_products_by_url($url, $url2 = null, $url3 = null)
    {
        $main_url = $url; // category or product url
        $sub_category_url = $url2;
        $brand_url = $url3;

        $category = null;
        $products = null;

        if ($url && $url2) {
            $url = $url . '/' . $url2;
        }

        $category = WebsiteUrl::where('table_name', 'categories')->where('url', $url)->first();
        // $category = Category::where('url', $url)->first();
        if ($category) {
            $category = Category::where('id', $category->table_id)->first();
            $category_id = $category->id;
            $min = request()->min && is_numeric(request()->min) ? request()->min : 0;
            $max = request()->max && is_numeric(request()->max) ? request()->max : 500000;
            $query_brands = request()->brands ? request()->brands : null;
            $query_availability = request()->availability ? request()->availability : null;

            $min_product_price = Product::orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::orderBy('sales_price', 'DESC')->first();

            $products = [];
            $links = '';

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
                $max_product_price = $max_product_price->sales_price;

                if (Category::where('id', $category_id)->exists()) {
                    $category = Category::where('id', $category_id)->first();

                    $data_query = $category->products()
                        ->whereBetween('products.sales_price', [$min, $max])
                        ->where('status', 1);

                    if(request()->has('varients')){
                        // dd(request()->varients);
                        $data_query->whereExists(function ($query) {
                            return $query->select(DB::raw(1))
                                  ->from('product_variant_value_products')
                                  ->whereColumn('product_variant_value_products.product_id', 'products.id')
                                  ->whereIn('product_variant_value_products.product_variant_value_id', request()->varients);
                        });
                    }

                    if ($query_brands) {
                        $data_query->whereIn('brand_id', $query_brands);
                    }

                    if ($query_availability) {
                        $data_query->where($query_availability, 1);
                    }

                    $data_query->orderBy('sales_price', 'ASC')
                        ->select([
                            'products.id',
                            'product_name',
                            'is_top_product',
                            'product_url',
                            'brand_id',
                            'selected_categories',
                            'short_description',
                            'cost',
                            'sales_price',
                            'call_for_price',
                            'is_upcomming',
                            'is_tba',
                            'is_pre_order',
                            'is_in_stock',
                            'low_stock',
                            'stock',
                        ])
                        // ->withSum('stocks','qty')
                        // ->withSum('sales','qty')
                    ;

                    $total = $data_query->count();
                    $page = request()->page ?? 1;
                    $perpage = 28;
                    $skip = ($page - 1) * $perpage;
                    $items = $data_query->skip($skip)->take($perpage)->get();
                    $data = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url($category->url)]);

                    $products = $data->items();
                    if ($min >= 0) {
                        $data->appends('min', $min);
                    }
                    if ($max >= 0) {
                        $data->appends('max', $max);
                    }
                    if ($query_brands) {
                        $data->appends('brands', $query_brands);
                    }
                    $links = $data->links()->render();
                }
            }

            $product_html = "";
            foreach ($products as $product) {
                $product_html .= view('website.include.product', compact('product'))->render();
            }
            return response()->json([
                'products' => $product_html ? $product_html : 'there is no product found.',
                'links' => $links,
                'category' => $category,
            ]);
        }

        $brand = WebsiteUrl::where('table_name', 'brands')->where('url', $url)->first();
        // $brand = Brand::where('url', $brand_url)->orWhere('url', $main_url)->first();
        if ($brand) {
            $brand = Brand::where('id', $brand->table_id)->first();
            $min = request()->min && is_numeric(request()->min) ? request()->min : 0;
            $max = request()->max && is_numeric(request()->max) ? request()->max : 500000;
            $query_brands = request()->brands ? request()->brands : null;
            $query_availability = request()->availability ? request()->availability : null;

            $min_product_price = Product::orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::orderBy('sales_price', 'DESC')->first();

            $products = [];
            $links = '';

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
                $max_product_price = $max_product_price->sales_price;

                $data_query = $brand->products()
                    ->whereBetween('products.sales_price', [$min, $max])
                    ->where('status', 1);

                if ($query_brands) {
                    $data_query->whereIn('brand_id', $query_brands);
                }

                if ($query_availability) {
                    $data_query->where($query_availability, 1);
                }

                $data_query->orderBy('sales_price', 'ASC')
                    ->select([
                        'products.id',
                        'product_name',
                        'is_top_product',
                        'product_url',
                        'brand_id',
                        'selected_categories',
                        'short_description',
                        'cost',
                        'sales_price',
                        'call_for_price',
                        'is_upcomming',
                        'is_tba',
                        'is_pre_order',
                        'is_in_stock',
                        'low_stock',
                        'stock',
                    ])
                    // ->withSum('stocks','qty')
                    // ->withSum('sales','qty')
                ;

                $total = $data_query->count();
                $page = request()->page ?? 1;
                $perpage = 20;
                $skip = ($page - 1) * $perpage;
                $items = $data_query->skip($skip)->take($perpage)->get();
                $data = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url($brand->url)]);

                $products = $data->items();
                if ($min >= 0) {
                    $data->appends('min', $min);
                }
                if ($max >= 0) {
                    $data->appends('max', $max);
                }
                if ($query_brands) {
                    $data->appends('brands', $query_brands);
                }
                $links = $data->links()->render();
            }

            $product_html = "";
            foreach ($products as $product) {
                $product_html .= view('website.include.product', compact('product'))->render();
            }
            return response()->json([
                'products' => $product_html ? $product_html : 'there is no product found.',
                'links' => $links,
                'category' => $category,
                'brand' => $brand,
            ]);
        }

        $tag = WebsiteUrl::where('table_name', 'tags')->where('url', $url)->first();
        // $tag = Tag::where('url', $main_url)->first();
        if ($tag) {
            $tag = Tag::where('url', $tag->table_id)->first();
            $min = request()->min && is_numeric(request()->min) ? request()->min : 0;
            $max = request()->max && is_numeric(request()->max) ? request()->max : 500000;
            $query_brands = request()->brands ? request()->brands : null;
            $query_availability = request()->availability ? request()->availability : null;

            $min_product_price = Product::orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::orderBy('sales_price', 'DESC')->first();

            $products = [];
            $links = '';

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
                $max_product_price = $max_product_price->sales_price;

                $data_query = $tag->products()
                    ->whereBetween('products.sales_price', [$min, $max])
                    ->where('status', 1);

                if ($query_brands) {
                    $data_query->whereIn('brand_id', $query_brands);
                }

                if ($query_availability) {
                    $data_query->where($query_availability, 1);
                }

                $data_query->orderBy('sales_price', 'ASC')
                    ->select([
                        'products.id',
                        'product_name',
                        'is_top_product',
                        'product_url',
                        'brand_id',
                        'selected_categories',
                        'short_description',
                        'cost',
                        'sales_price',
                        'call_for_price',
                        'is_upcomming',
                        'is_tba',
                        'is_pre_order',
                        'is_in_stock',
                        'low_stock',
                        'stock',
                    ])
                    // ->withSum('stocks','qty')
                    // ->withSum('sales','qty')
                ;

                $total = $data_query->count();
                $page = request()->page ?? 1;
                $perpage = 20;
                $skip = ($page - 1) * $perpage;
                $items = $data_query->skip($skip)->take($perpage)->get();
                $data = new LengthAwarePaginator($items, $total, $perpage, $page, ["path" => url($tag->url)]);

                $products = $data->items();
                if ($min >= 0) {
                    $data->appends('min', $min);
                }
                if ($max >= 0) {
                    $data->appends('max', $max);
                }
                if ($query_brands) {
                    $data->appends('brands', $query_brands);
                }
                $links = $data->links()->render();
            }

            $product_html = "";
            foreach ($products as $product) {
                $product_html .= view('website.include.product', compact('product'))->render();
            }
            return response()->json([
                'products' => $product_html ? $product_html : 'there is no product found.',
                'links' => $links,
                'category' => $category,
                'brand' => $brand,
                'tag' => $tag,
            ]);
        }

        return response()->json([
            "products" => "",
            "links" => "",
            "category" => [],
        ]);
    }

    public function category_product_brands($category_id)
    {
        $brand_ids = Product::select('brand_id')->whereJsonContains('selected_categories', $category_id)->groupBy('brand_id')->get()->map(function ($e) {
            return $e->brand_id;
        });
        $brands = Brand::select('id', 'name', 'url')->whereIn('id', $brand_ids)->orderBy('name', 'ASC')->get()->unique('name');
        $query_brands = request()->brands ? request()->brands : null;
        $brand_html = view('website.include.brand', compact('brands', 'query_brands'))->render();

        $exists_varients = DB::table('product_variant_value_products')
            // ->crossJoin('category_product')
            ->leftJoin('category_product', 'category_product.product_id', '=', 'product_variant_value_products.product_id')
            ->where('category_product.category_id', $category_id)
            ->limit(50)
            ->get()
            ->unique('product_variant_value_id')
            ->sort();

        $varient_value_ids = $exists_varients->map(function ($e) {
            return $e->product_variant_value_id;
        })->toArray();

        $varient_ids = $exists_varients->unique('product_variant_id')
            ->map(function ($e) {
                return $e->product_variant_id;
            })
            ->sort()
            ->toArray();

        $varients = ProductVariant::whereIn('id', $varient_ids)
            ->with([
                'values' => function ($q) use ($varient_value_ids) {
                    $q->whereIn('id', $varient_value_ids);
                }
            ])
            ->get();

        $query_varients = request()->varients??[];
        // dd(in_array(99, $query_varients));
        $varient_html = view('website.include.varients', compact('varients', 'query_varients'))->render();
        // dd($varients);
        return response()->json([
            "data" => $brand_html,
            "brands" => $brands,
            "varient" => $varient_html,
        ]);
    }
}
