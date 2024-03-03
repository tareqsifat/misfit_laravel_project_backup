<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\ProductStock;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shipping;
use App\Models\ShippingStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
use Mail;

class OrderController extends Controller
{
    public function orders(Request $request){
        $search = $request->keyword;


        $product_slug = Product::get('pro_slug')->where('status', 1);
        $product_url = 'https://stygen.gift/product/' . $product_slug;
        if($search != null){
            if($search == 'Pending'){
                $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->select('orders.id','orders.invoice_no','orders.created_at','orders.total_amount','orders.customer_id','orders.invoice_date','orders.shipping_status_id','orders.bkash_number','orders.bkash_transaction','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with('customer')
                ->orderBy('orders.id','desc')
                ->where(function ($query) use ($search) {
                    $query->where("orders.shipping_status_id", "LIKE", "Pending")
                        ->orWhere("orders.shipping_status_id", "LIKE", "Accepted")
                        ->orWhere("orders.shipping_status_id", "LIKE", "Shipped to Stygen");
                })
                ->paginate(20);
            } else {
                $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->select('orders.id','orders.invoice_no', 'orders.created_at','orders.total_amount','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with('customer')
                ->orderBy('orders.id','desc')
                ->where(function ($query) use ($search) {
                    $query->where("orders.id", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_no", "LIKE", "%{$search}%")
                        ->orWhere("customers.customer_name", "LIKE", "%{$search}%")
                        ->orWhere("customers.customer_phone", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_date", "LIKE", "%{$search}%")
                        ->orWhere("orders.shipping_status_id", "LIKE", "%{$search}%")
                        //->orWhere("order_details.status", "LIKE", "%{$search}%")
                        ->orWhere("order_details.price", "LIKE", "%{$search}%")
                        ->orWhere("order_details.quantity", "LIKE", "%{$search}%")
                        ->orWhere("orders.created_at", "LIKE", "%{$search}%");
                })
                ->paginate(20);
            }
        } else {
            $orders = Order::join('order_details','order_details.order_id','=','orders.id')
            ->groupBy('order_details.order_id')
            ->with('customer')
            ->select('orders.*')
            ->orderBy('orders.id','desc')->paginate(20);
        }

        return response()->json([
            'orders'    => $orders
        ], 200);
    }

    //Search
    public function searchAdminOrder(Request $request)
    {
        $search = $request->keyword;

        if($search != null){
            if($search == 'Pending' || $search == 'pending'){
                $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->select('orders.id','orders.invoice_no','orders.created_at','orders.total_amount','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with('customer')
                ->orderBy('orders.id','desc')
                ->where(function ($query) use ($search) {
                    $query->where("orders.shipping_status_id", "LIKE", "Pending")
                        ->orWhere("orders.shipping_status_id", "LIKE", "Accepted")
                        ->orWhere("orders.shipping_status_id", "LIKE", "Shipped to Stygen");
                })
                ->paginate(20);
            } else {
                if($search == 'Pending' || $search == 'pending'){
                    $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                    ->join('customers', 'orders.customer_id', 'customers.id')
                    ->select('orders.id','orders.total_amount', 'orders.created_at','orders.invoice_no','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                    ->groupBy('orders.id')
                    ->with('customer')
                    ->orderBy('orders.id','desc')
                    ->where(function ($query) {
                        $query->where("orders.shipping_status_id", "LIKE", "Pending")
                            ->orWhere("orders.shipping_status_id", "LIKE", "Accepted")
                            ->orWhere("orders.shipping_status_id", "LIKE", "Shipped to Stygen");
                    })
                    ->paginate(20);
                } else {
                    $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                        ->join('customers', 'orders.customer_id', 'customers.id')
                        ->select('orders.id','orders.total_amount', 'orders.created_at','orders.invoice_no','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                        ->groupBy('orders.id')
                        ->with('customer')
                        ->orderBy('orders.id','desc')
                        ->where(function ($query) use ($search) {
                            $query->where("orders.id", "LIKE", "%{$search}%")
                                ->orWhere("orders.invoice_no", "LIKE", "%{$search}%")
                                ->orWhere("customers.customer_name", "LIKE", "%{$search}%")
                                ->orWhere("customers.customer_phone", "LIKE", "%{$search}%")
                                ->orWhere("orders.invoice_date", "LIKE", "%{$search}%")
                                ->orWhere("orders.shipping_status_id", "LIKE", "%{$search}%")
                                //->orWhere("order_details.status", "LIKE", "%{$search}%")
                                ->orWhere("order_details.price", "LIKE", "%{$search}%")
                                ->orWhere("order_details.quantity", "LIKE", "%{$search}%")
                                ->orWhere("orders.created_at", "LIKE", "%{$search}%");
                        })
                        ->paginate(20);
                }
            }
            return response()->json([
                'orders' => $orders
            ], 200);
        }else{
            return $this->orders($request);
        }
    }

    public function getShippingStatus()
    {
        //$ids = ['1','2','3','4','5'];
        $shipping_statuses = ShippingStatus::where('status', 1)->get();
        $all_status = Order::get()->count();
        $pending = Order::where('shipping_status_id', 'Pending')->orWhere('shipping_status_id', 'Accepted')->orWhere('shipping_status_id', 'Shipped to Stygen')->get()->count();
        $in_transit = Order::where('shipping_status_id', 'In Transit')->get()->count();
        $hold = Order::where('shipping_status_id', 'Hold')->get()->count();
        $delivered = Order::where('shipping_status_id', 'Delivered')->get()->count();
        $canceled = Order::where('shipping_status_id', 'Canceled')->get()->count();
        $returned = Order::where('shipping_status_id', 'Returned')->get()->count();
        $return_to_merchant = Order::where('shipping_status_id', 'Return to Merchant')->get()->count();

        return response()->json([
            'shipping_statuses' => $shipping_statuses,
            'all_status'        => $all_status,
            'pending'           => $pending,
            'in_transit'        => $in_transit,
            'hold'              => $hold,
            'delivered'         => $delivered,
            'canceled'          => $canceled,
            'returned'          => $returned,
            'return_to_merchant'=> $return_to_merchant
        ], 200);
    }

    public function orderStatusChange(Request $request)
    {
        $status     = $request->status;
        $order_id   = $request->order_id;

        Order::where('id', $order_id)->update([
            'shipping_status_id' => $status
        ]);


        $order = Order::where('id', $order_id)->select('name','email','total_amount')->first();

        $order_details = OrderDetail::where('order_id', $order_id)->get();

        // if($status == "In Transit") {
        //     foreach($order_details as $order_detail){
        //         $product_stock = new ProductStock();
        //         $product_stock->product_id = $order_detail->product_id;
        //         $product_stock->company_id = $order_detail->company_id;
        //         $product_stock->type = "sell";
        //         $product_stock->qty  = $order_details->quantity;
        //         $product_stock->save();
        //     }
        // }
        if($status == 'Canceled') {
            foreach($order_details as $order_detail){
                $product_stock = new ProductStock();
                $product_stock->product_id = $order_detail->product_id;
                $product_stock->company_id = $order_detail->company_id;
                $product_stock->type = "purchase";
                $product_stock->qty  = $order_detail->quantity;
                $product_stock->save();
            }
        }
        if($status == 'Delivered' || $status == 'Canceled'){
            $buyer_email = $order->email;
            if(!empty($buyer_email)){

                // mailchimp status update
                $client = new \MailchimpMarketing\ApiClient();

                $client->setConfig([
                    'apiKey' => config('services.mailchimp.key'),
                    'server' => 'us20',
                ]);

                $orders = $client->ecommerce->getStoreOrders("stygen");

                if($status == 'Delivered') {
                    foreach($orders->orders as $mcustomer) {

                        $response = $client->ecommerce->updateOrder("stygen", "$mcustomer->id", [
                            "fulfillment_status" => "paid"
                        ]);

                    }
                    $buyer_details = [
                        'name'  => $order->name,
                        'title' => 'We successfully delivered your order. Thanks for shopping with us.',
                        'body'  => 'If you like our service Provide us a review of your shopping experience.',
                        'button' => 'Write a review',
                    ];
                    \Mail::to($buyer_email)->send(new \App\Mail\BuyerEmail($buyer_details));
                }

                if($status == 'Canceled') {
                    $companyId = [];
                    foreach($orders->orders as $mcustomer) {
                        $response = $client->ecommerce->updateOrder("stygen", "$mcustomer->id", [
                            "fulfillment_status" => "cancelled"
                        ]);
                    }
                    $buyer_details = [
                        'name'  => $order->name,
                    ];
                    \Mail::to($buyer_email)->send(new \App\Mail\BuyerCancel($buyer_details));
                }
            }

            // if(!empty($companyId)){
            //     foreach($companyId as $cid){
            //         $seller_info = Seller::where('company_id', $cid)->select('name','email')->first();
            //         $seller_email = $seller_info->email;
            //         if(!empty($seller_email)){
            //             if($status == 'In Transit' || $status == 'Returned' || $status == 'Delivered'){
            //                 $seller_details = [
            //                     'name'  => $seller_info->name,
            //                     'title' => 'Order is In Transit',
            //                     'body' => 'Your order status is In Transit.'
            //                 ];
            //             }

            //             if($status == 'Returned'){
            //                 $seller_details = [
            //                     'name'  => $seller_info->name,
            //                     'title' => 'Order is Returned',
            //                     'body' => 'Your order status is Returned.'
            //                 ];
            //             }
            //             \Mail::to($seller_email)->send(new \App\Mail\SellerEmail($seller_details));
            //         }
            //     }
            // }
        }

        return response()->json('Success');
    }

    // public function orderStatusChange(Request $request)
    // {
    //     $status     = $request->status;
    //     $order_details_id   = $request->order_details_id;

    //     OrderDetail::where('id', $order_details_id)->update([
    //         'status' => $status
    //     ]);

    //     $orderDetailInfo = OrderDetail::where('id', $order_details_id)->select('company_id', 'order_id')->first();
    //     $order = Order::where('id', $orderDetailInfo->order_id)->select('name','email')->first();


    //     if($status == 'In Transit' || $status == 'Returned'){
    //         $buyer_email = $order->email;
    //         if(!empty($buyer_email)){
    //             if($status == 'In Transit'){
    //                 $buyer_details = [
    //                     'name'  => $order->name,
    //                     'title' => 'Order is In Transit',
    //                     'body'  => 'Your order status is In Transit.'
    //                 ];
    //             }

    //             if($status == 'Returned'){
    //                 $buyer_details = [
    //                     'name'  => $order->name,
    //                     'title' => 'Order is Returned',
    //                     'body'  => 'Your order status is Returned.'
    //                 ];
    //             }

    //             \Mail::to($buyer_email)->send(new \App\Mail\BuyerEmail($buyer_details));
    //         }

    //         if(!empty($orderDetailInfo->company_id)){
    //             $seller_info = Seller::where('company_id', $orderDetailInfo->company_id)->select('name','email')->first();
    //             $seller_email = $seller_info->email;
    //             if(!empty($seller_email)){
    //                 if($status == 'In Transit' || $status == 'Returned'){
    //                     $seller_details = [
    //                         'name'  => $seller_info->name,
    //                         'title' => 'Order is In Transit',
    //                         'body' => 'Your order status is In Transit.'
    //                     ];
    //                 }

    //                 if($status == 'Returned'){
    //                     $seller_details = [
    //                         'name'  => $seller_info->name,
    //                         'title' => 'Order is Returned',
    //                         'body' => 'Your order status is Returned.'
    //                     ];
    //                 }
    //                 \Mail::to($seller_email)->send(new \App\Mail\SellerEmail($seller_details));
    //             }
    //         }
    //     }

    //     return response()->json('Success');
    // }

    public function orders_details($id){
        $order_details = OrderDetail::where('order_id', $id)->with('product')->get();
        $total_amount  = OrderDetail::where('order_id', $id)->select(DB::raw('sum(price * quantity) as total'))->get();
        $order         = Order::with('order_attributes', 'card','packaging')->find($id);
        $customer      = Customer::where('id', $order->customer_id)->first();
        $shipping      = Shipping::where('id', $order->shipping_id)->first();
        $bkash   = Order::where('bkash_payment_id', '!=', '')->where('bkash_payment_id', '!=', 'undefined')->where('id', $id)->get()->toarray();

        if(isset($bkash) && count($bkash) > 0) {
            $bkash_check = 5;
        }
        else {
            $bkash_check = '';
        }
        // dd($bkash_check);

        return response()->json([
            'order_details'             => $order_details,
            'order'                     => $order,
            'total_amount'              => $total_amount,
            'invoice_no'                => $order->invoice_no,
            'invoice_date'              => $order->invoice_date,
            'delivery_date'             => $order->delivery_date,
            'payment_type'              => $order->payment_type,
            'customer_name'             => $customer->customer_name,
            'customer_phone'            => $customer->customer_phone,
            'customer_email'            => $customer->customer_email,
            'customer_address'          => $customer->customer_address,
            'shipping_name'             => $shipping->shipping_name,
            'shipping_phone'            => $shipping->shipping_phone,
            'shipping_email'            => $shipping->shipping_email,
            'shipping_address'          => $shipping->shipping_address,
            'ship_to_gift'              => $order->ship_to_gift,
            'card_name'                 => (!empty($order->card))?$order->card->name:NULL,
            'pacakging_name'            => (!empty($order->packaging))?$order->packaging->name:NULL,
            'shipping_charge'           => $order->shipping_charge,
            'card_price'                => $order->card_price,
            'packaging_price'           => $order->packaging_price,
            'discount_amount'           => $order->discount_amount,
            'net_receiveable_amount'    => $order->net_receiveable_amount,
            'personal_notes'            => $order->personal_notes,
            'company_name'              => 'STYGEN',
            'company_phone'             => '+880 1971 971 520',
            'company_address'           => 'House: 65, Level-2, Road: 03, Block: B, Niketon, Gulshan-1, Dhaka',
            'bkash_check'               => $bkash_check
        ], 200);
    }

    public function AdmininvoiceDownload($id){
        $companyId = Auth::guard('admin')->user()->id;
        $data['order'] = Order::with('customer','order_attributes', 'shipping')->find($id);
        $data['order_details'] = OrderDetail::where('order_id', $id)->with('product')->get();
        $data['companyInfo'] = Admin::where('id', $companyId)->first();
        $pdf = PDF::loadView('backend.invoice_pdf', $data);
        return $pdf->output();
    }

    public function orderNoteUpdate(Request $request) {
        $order_id   = $request->order_id;
        $note       = $request->note;
        $order = Order::where('id', $order_id)->first();
        if(!empty($order)) {
            $order->update([
                'admin_note' => $note
            ]);
        }
        return response()->json([
            'success'  => 'Note Updated Successfully'
        ]);
    }
    public function last_month_order() {
        $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->select('orders.id','orders.total_amount', 'orders.created_at','orders.invoice_no','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status','order_details.product_id', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with(['customer','order_details'=> function ($query) {
                        $query->with('product');
                    }
                ])
                ->orderBy('orders.id','desc')
                ->where('shipping_status_id', 'Delivered')
                ->whereMonth('orders.created_at', '=', Carbon::now()->subMonth()->month)->get();

                $orders_data = [];

                foreach($orders as $order) {
                    $temp_arr = [];
                    $temp_arr['Order_id'] = '';
                    $temp_arr['invoice_no'] = '';
                    $temp_arr['customer_name'] = '';
                    $temp_arr['customer_phone'] = '';
                    $temp_arr['customer_address'] = '';
                    $temp_arr['total_amount'] = '';
                    $temp_arr['product_name'] = '';

                    $temp_arr['Order_id'] = $order->id;
                    $temp_arr['invoice_no'] = $order->invoice_no;
                    $temp_arr['customer_name'] = $order->customer->customer_name;
                    $temp_arr['customer_phone'] = $order->customer->customer_phone;
                    $temp_arr['customer_address'] = $order->customer->customer_address;
                    $temp_arr['total_amount'] = $order->total_amount;
                    $temp_arr['status'] = $order->shipping_status_id;

                    // dd($order, $order->order_details);
                    if(isset($order->order_details) && count($order->order_details) > 0) {
                        foreach($order->order_details as $orders_detail) {
                            if(isset($orders_detail->product->product_name)) {
                                $temp_product = $orders_detail->product->product_name . ',';
                            }
                        }
                        $temp_arr['product_name'] = $temp_product;
                    }
                   array_push($orders_data, $temp_arr);
                }

                return response()->json([
                    'orders_data'    => $orders_data
                ], 200);
    }

    public function all_customers(Customer $customer) {
        $customers = Customer::select('customer_email','customer_name','customer_address')->where('customer_email', '!=', 'null')->distinct('customer_email')->get();
        return response()->json([
            'customers'    => $customers
        ], 200);
    }

    public function couponsearch(Request $request) {
        $search = $request->keyword;

        $coupons = Coupon::with('users')
                ->where('status', 1)
                ->where('status', '!=', 0)
                ->where(function ($query) use ($search) {
                    $query->where("title", "LIKE", "%{$search}%")
                        ->orWhere("code", "LIKE", "%{$search}%")
                        ->orWhere("start_date", "LIKE", "%{$search}%")
                        ->orWhere("expire_date", "LIKE", "%{$search}%")
                        ->orWhere("minimum_spent", "LIKE", "%{$search}%")
                        ->orWhere("coupon_type", "LIKE", "%{$search}%")
                        // ->orWhere("users.name", "LIKE", "%{$search}%")
                        ->orWhere("maximum_spent", "LIKE", "%{$search}%");
                })
                ->orderBy('id','desc')
                ->paginate(30);

                // dd($coupons);
        return response()->json([
            'coupons'    => $coupons
        ], 200);

    }
}
