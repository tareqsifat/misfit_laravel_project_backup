<?php

namespace App\Http\Controllers\Backend;

use App\Charts\CustomChart;
use App\Charts\DailySales;
use App\Charts\MonthlySalesChart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    //Sale By Category
    public function sale_by_categories()
    {
        $sale_by_categories = Category::join('product_categories','categories.id','=','product_categories.category_id')
                            ->join('order_details','order_details.product_id','=','product_categories.product_id')
                            ->select('categories.id','categories.category_name', DB::raw('count("order_details.id") as total'))
                            ->groupBy('categories.id')
                            ->paginate(10);

        $total_sale_by_categories = Category::join('product_categories','categories.id','=','product_categories.category_id')
                            ->join('order_details','order_details.product_id','=','product_categories.product_id')
                            ->select('categories.id','categories.category_name', DB::raw('count("order_details.id") as total'))
                            ->groupBy('categories.id')
                            ->get()->sum('total');

       return response()->json([
        'sale_by_categories'        => $sale_by_categories,
        'total_sale_by_categories'  => $total_sale_by_categories,
       ], 200);
    }

    //Sale By Product
    public function sale_by_products()
    {
        $sale_by_products = Product::join('order_details','order_details.product_id','=','products.id')
                        ->select('products.id','products.product_name', DB::raw('count("order_details.id") as total'))
                        ->groupBy('products.id')
                        ->paginate(10);

        $total_sale_by_products = Product::join('order_details','order_details.product_id','=','products.id')
                        ->select('products.id','products.product_name', DB::raw('count("order_details.id") as total'))
                        ->groupBy('products.id')
                        ->get()->sum('total');

        return response()->json([
            'sale_by_products'          => $sale_by_products,
            'total_sale_by_products'    => $total_sale_by_products
        ], 200);
    }

    //Sale By Seller
    public function sale_by_sellers()
    {
        $sale_by_sellers = Seller::join('order_details','order_details.company_id','=','sellers.company_id')
                        ->select('sellers.id','sellers.name', DB::raw('count("order_details.id") as total'))
                        ->groupBy('sellers.id')
                        ->paginate(10);

        $total_sale_by_sellers = Seller::join('order_details','order_details.company_id','=','sellers.company_id')
                        ->select('sellers.id','sellers.name', DB::raw('count("order_details.id") as total'))
                        ->groupBy('sellers.id')
                        ->get()->sum('total');

        return response()->json([
            'sale_by_sellers'       => $sale_by_sellers,
            'total_sale_by_sellers' => $total_sale_by_sellers,
        ], 200);
    }

    // order id ,invoice no, customer name, address, amount, product
    public function weekly_user() {
        $users = User::whereBetween('created_at',
                [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
            )
            ->count();
        dd($users);
    }

    public function daily_order(DailySales $chart) {
        // return response()->json([
        //     'order_count'       => $orderCount,
        //     'countdays'         => $countdays
        // ], 200);
        return view('backend.dashboard-report',['chart' => $chart->build()]);
    }

    public function monthly_order(MonthlySalesChart $chart) {

        return view('backend.dashboard-report-monthly',['chart' => $chart->build()]);
    }

    public function custom_order(Request $request, CustomChart $customchart) {
        return view('backend.dashboard_custom', ['chart' => $customchart->build($request)]);
    }
}
