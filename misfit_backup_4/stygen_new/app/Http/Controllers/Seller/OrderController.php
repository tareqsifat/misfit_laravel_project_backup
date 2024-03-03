<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Seller;
use App\Models\ShippingStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class OrderController extends Controller
{
    public function orders(Request $request){
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;

        if($search != null){
            $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->where('order_details.company_id', $companyId)
                ->select('orders.id as orderID','orders.invoice_no','orders.customer_id', 'orders.created_at','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with('customer')
                ->orderBy('orders.id','desc')
                ->where(function ($query) use ($search) {
                    $query->where("orders.id", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_no", "LIKE", "%{$search}%")
                        ->orWhere("customers.customer_name", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_date", "LIKE", "%{$search}%")
                        ->orWhere("orders.shipping_status_id", "LIKE", "%{$search}%")
                        //->orWhere("order_details.status", "LIKE", "%{$search}%")
                        ->orWhere("order_details.price", "LIKE", "%{$search}%")
                        ->orWhere("order_details.quantity", "LIKE", "%{$search}%")
                        ->orWhere("orders.created_at", "LIKE", "%{$search}%");
                })
                ->paginate(10);
        } else {
            $orders = Order::join('order_details','order_details.order_id','=','orders.id')
            ->where('order_details.company_id', $companyId)
            ->select('orders.id as orderID','orders.customer_id', 'orders.created_at','orders.invoice_no','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
            ->groupBy('orders.id')
            ->with('customer')
            ->orderBy('orders.id','desc')
            ->paginate(10);
        }

        return response()->json([
            'orders'    => $orders
        ], 200);
    }

    //Search
    public function searchSellerOrder(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;

        if($search != null){
            $orders = Order::join('order_details','order_details.order_id','=','orders.id')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->where('order_details.company_id', $companyId)
                ->select('orders.id as orderID','orders.invoice_no','orders.customer_id','orders.invoice_date','orders.shipping_status_id','order_details.status', DB::raw('sum(order_details.price * order_details.quantity) as total'))
                ->groupBy('orders.id')
                ->with('customer')
                ->orderBy('orders.id','desc')
                ->where(function ($query) use ($search) {
                    $query->where("orders.id", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_no", "LIKE", "%{$search}%")
                        ->orWhere("customers.customer_name", "LIKE", "%{$search}%")
                        ->orWhere("orders.invoice_date", "LIKE", "%{$search}%")
                        ->orWhere("orders.shipping_status_id", "LIKE", "%{$search}%")
                        //->orWhere("order_details.status", "LIKE", "%{$search}%")
                        ->orWhere("order_details.price", "LIKE", "%{$search}%")
                        ->orWhere("order_details.quantity", "LIKE", "%{$search}%")
                        ->orWhere("orders.created_at", "LIKE", "%{$search}%");
                })
                ->paginate(10);
            return response()->json([
                'orders' => $orders
            ], 200);
        }else{
            return $this->orders($request);
        }
    }

    public function getShippingStatus()
    {
        $ids = ['4','5','6','8','9'];
        $shipping_statuses = ShippingStatus::where('status', 1)->whereNotIn('id', $ids)->get();
        return response()->json([
            'shipping_statuses' => $shipping_statuses
        ], 200);
    }

    public function orderStatusChange(Request $request)
    {
        $status     = $request->status;
        $order_id   = $request->order_id;
        $companyId = Auth::guard('seller')->user()->company_id;

        Order::where('id', $order_id)->update([
            'shipping_status_id' => $status
        ]);


        $orderDetails = OrderDetail::where('order_id', $order_id)->where('company_id', $companyId)->get();
        foreach($orderDetails as $orderDetail){
            $orderDetail->update([
                'status' => $status
            ]);
        }

        return response()->json('Success');
    }

    public function orders_details($id){
        $companyId = Auth::guard('seller')->user()->company_id;
        $order_details = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->with('product')->get();
        $total_amount  = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->select(DB::raw('sum(price * quantity) as total'))->get();
        $netTotal      = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->select(DB::raw('sum(price * quantity) as total'))->get()->sum('total');
        $order         = Order::with('order_attributes')->find($id);
        $customer      = Customer::where('id', $order->customer_id)->first();
        $company_info  = Auth::guard('seller')->user();
        $productIds    = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->get()->pluck('product_id');
        $productInfos  = Product::whereIn('id', $productIds)->where('status', 1)->select('regular_price','sales_price')->get();
        $discount_amount = 0;
        foreach($productInfos as $product){
            if($product->sales_price > 0 && $product->sales_price != NULL){
                $netDiscount = ($product->regular_price) - ($product->sales_price);
                $discount_amount += $netDiscount;
            }
        }
        if(!empty($discount_amount)){
            $net_receivable = $netTotal - $discount_amount;
        }else{
            $net_receivable = $netTotal;
        }

        return response()->json([
            'order_details'    => $order_details,
            'order'            => $order,
            'total_amount'     => $total_amount,
            'invoice_no'       => $order->invoice_no,
            'invoice_date'     => $order->invoice_date,
            'delivery_date'    => $order->delivery_date,
            'payment_type'     => $order->payment_type,
            'customer_name'    => $customer->customer_name,
            'customer_phone'   => $customer->customer_phone,
            'customer_email'   => $customer->customer_email,
            'customer_address' => $customer->customer_address,
            'company_name'     => $company_info->name,
            'company_phone'    => $company_info->phone,
            'company_address'  => $company_info->address,
            'discount_amount'  => $discount_amount,
            'net_receivable'   => $net_receivable,
        ], 200);
    }

    public function invoiceUserDownload($id){
        $companyId = Auth::guard('seller')->user()->company_id;
        $data['order'] = Order::with('customer','order_attributes')->find($id);
        $data['order_details'] = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->with('product')->get();
        $data['companyInfo'] = Seller::where('company_id', $companyId)->first();
        $netTotal      = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->select(DB::raw('sum(price * quantity) as total'))->get()->sum('total');
        $productIds    = OrderDetail::where('order_id', $id)->where('company_id', $companyId)->get()->pluck('product_id');
        $productInfos  = Product::whereIn('id', $productIds)->where('status', 1)->select('regular_price','sales_price')->get();
        $discount_amount = 0;
        foreach($productInfos as $product){
            if($product->sales_price > 0 && $product->sales_price != NULL){
                $netDiscount = ($product->regular_price) - ($product->sales_price);
                $discount_amount += $netDiscount;
            }
        }
        if(!empty($discount_amount)){
            $net_receivable = $netTotal - $discount_amount;
        }else{
            $net_receivable = $netTotal;
        }
        $data['discount_amount'] = $discount_amount;
        $data['net_receivable'] = $net_receivable;
        $pdf = PDF::loadView('seller.invoice_pdf', $data);
        return $pdf->output();
    }
}
