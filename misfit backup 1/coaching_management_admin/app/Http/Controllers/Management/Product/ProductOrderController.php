<?php

namespace App\Http\Controllers\Management\Product;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountCategory;
use App\Models\Accounts\BranchAccount;
use App\Models\Accounts\BranchAccountLog;
use App\Models\Order\ProductOrder;
use App\Models\Order\ProductOrderDetail;
use App\Models\Product\ProductStockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductOrderController extends Controller
{

    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        return $branch_admin->branch_admin[0]->branch_details->id;
    }
    
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = ProductOrder::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('price', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with(['user', 'order_details'])->paginate($paginate);
        return response()->json($users);
    }

    public function branch_order_all()
    {
        
        $paginate = (int) request()->paginate;

        $query = ProductOrder::where('user_id', auth()->user()->id);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('price', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with(['user', 'order_details'])->paginate($paginate);
        return response()->json($users);
    }

    public function show($id)
    {
        $data = ProductOrder::where('id', $id)->with(['user','order_details' => function($q) {
            $q->with('product');
        }])->first();

        if (!$data) {
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role' => ['data not found']],
            ], 422);
        }
        return response()->json($data, 200);
    }

    public function store()
    {
        
        // dd(request()->all());
        $data = new ProductOrder();
        $data->invoice_id = uniqid();
        $data->user_id = Auth::user()->id;
        $data->total_amount = request()->total_price;
        $data->paid_amount = request()->paid_amount;
        $data->status = "pending";
        $data->payment_status = "pending";
        $data->save();
        
        /*
            For single product order
         */
        if(request()->has('product_id')) {
            $order_detail = new ProductOrderDetail();
            $order_detail->product_id = request()->product_id;
            $order_detail->order_id = $data['id'];
            $order_detail->qty = request()->qty;
            $order_detail->price = request()->price;
            $order_detail->total = request()->price * request()->qty;
            $order_detail->save();

            $stock_log = new ProductStockLog();
            $stock_log->product_id = request()->product_id;
            $stock_log->qty = request()->qty;
            $stock_log->type = "sell";
            $stock_log->save();

            /*
                FInd the category named purchase
                if that category not found create a new one
            */
            // $account_category = AccountCategory::where('title', 'purchase')->first();
            // if (is_null($account_category)) {
            //     $account_category = new AccountCategory();
            //     $account_category->title = 'purchase';
            //     $account_category->is_visible = 0;
            //     $account_category->save();
            // }

            // $account_id = BranchAccount::where('title', 'cash')->first();

            // /*
            //   Insert the order into branch account log table with purchase
            // */
            // $account_log = new BranchAccountLog();
            // $account_log->branch_id = $this->getBranchID(); // Get the branch of the Logged in users branch id
            // $account_log->account_category_id = $account_category->id;
            // $account_log->account_id = $account_id->id;
            // $account_log->amount = $data->total_price;
            // $account_log->type = "debit";
            // $account_log->description = "order from branch";
            // $account_log->is_expense = 1;
            // $account_log->is_income = 0;
            // $account_log->save();
            return response()->json($data, 200);
        }

        // for multiple product order
        if (request()->has('products')) {
            $products = json_decode(request()->products);

            foreach ($products as $key => $value) {
                $order_detail = new ProductOrderDetail();
                $order_detail->product_id = $value->id;
                $order_detail->order_id = $data->id;
                $order_detail->qty = $value->qty;
                $order_detail->price = $value->price;
                $order_detail->total = $value->qty * $value->price;
                $order_detail->save();
    
                $stock_log = new ProductStockLog();
                $stock_log->product_id = $value->id;
                $stock_log->qty = $value->qty;
                $stock_log->type = "sell";
                $stock_log->save();
                
            }
            /*
                FInd the category named purchase
                if that category not found create a new one
            */
            // $account_category = AccountCategory::where('title', 'purchase')->first();
            // if (is_null($account_category)) {
            //     $account_category = new AccountCategory();
            //     $account_category->title = 'purchase';
            //     $account_category->is_visible = 0;
            //     $account_category->save();
            // }
            
            // $account_id = BranchAccount::where('title', 'cash')->first();
            // /*
            //     Insert the order into branch account log table with purchase
            // */

            // $account_log = new BranchAccountLog();
            // $account_log->branch_id = $this->getBranchID(); //Get the branch of the Logged in users branch id
            // $account_log->account_category_id = $account_category->id;
            // $account_log->account_id = $account_id->id;
            // $account_log->amount = request()->total_price;
            // $account_log->type = "debit";
            // $account_log->description = "order from branch";
            // $account_log->is_expense = 1;
            // $account_log->is_income = 0;
            // $account_log->save();
            return response()->json($data, 200);
        }
    }


    public function update_status()
    {
        $data = ProductOrder::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['ProductOrder not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        
        if(request()->status == 'canceled') {
            $qty = 0;
            foreach ($data->order_details as $key => $order) {
                $qty += $order->qty;
                $check_stock_log = ProductStockLog::where('product_id', $order->product_id)
                ->where('qty', $qty)
                ->where('type', "return")
                ->first();
                if($check_stock_log == null) {
                    ProductStockLog::create([
                        'product_id' => $order->product_id,
                        'qty' => $qty,
                        'type' => "return",
                        'creator' => auth()->user()->id,
                    ]);
                }
            }
        }
        $data->status = request()->status;
        $data->payment_status = request()->payment_status;
        $data->update();

        return response()->json($data, 200);
    }

    public function update_order() {

        $data = ProductOrder::find(request()->order_id);

        if (request()->has('products')) {

            $products = json_decode(request()->products);

            foreach ($products as $key => $value) {
                // dd($value->id);
                $order_detail = ProductOrderDetail::where('order_id', request()->order_id)->first();
                $order_detail->product_id = $value->id;
                $order_detail->order_id = $data->id;
                $order_detail->qty = (int) $value->qty;
                $order_detail->price = (int) $value->price;
                $order_detail->total = $value->qty * $value->price;
                $order_detail->save();
    
                $stock_log = new ProductStockLog();
                $stock_log->product_id = $value->id;
                $stock_log->qty = $value->qty;
                $stock_log->type = "sell";
                $stock_log->save();
                
            }
        }
        $data->total_amount = request()->total_price;
        $data->save();
        return response()->json($data, 200);
        
    }

    public function payment_status_update()  {
        $data = ProductOrder::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['ProductOrder not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        /*
            FInd the category named purchase
            if that category not found create a new one
        */
        $account_category = AccountCategory::where('title', 'purchase')->first();
        if (is_null($account_category)) {
            $account_category = new AccountCategory();
            $account_category->title = 'purchase';
            $account_category->is_visible = 0;
            $account_category->save();
        }
        
        $account_id = BranchAccount::where('title', 'cash')->first();
        /*
            Insert the order into branch account log table with purchase
        */

        $account_log = new BranchAccountLog();
        $account_log->branch_id = $this->getBranchID(); //Get the branch of the Logged in users branch id
        $account_log->account_category_id = $account_category->id;
        $account_log->account_id = $account_id->id;
        $account_log->amount = request()->total_price;
        $account_log->type = "debit";
        $account_log->description = "order from branch";
        $account_log->is_expense = 1;
        $account_log->is_income = 0;
        $account_log->save();

        $data->paid_amount = request()->order_amount;
        $data->payment_status = "pending";
        $data->account_log_id = $account_log->id;
        $data->update();

        return response()->json($data, 200);
    }

    public function get_order_payment($id)  {
        $order_payment = ProductOrder::where('id', $id)->with('account_log')->first();
        
        return response()->json($order_payment, 200);
    }

    public function manipulate_order()
    {
        $data = ProductOrder::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['ProductOrder not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->total_amount = request()->total_amount;
        $data->paid_amount = request()->paid_amount;
        $data->status = request()->status;
        $data->update();

        return response()->json($data, 200);
    }

    // public function canvas_update()
    // {
    //     $data = ProductOrder::find(request()->id);
    //     if(!$data){
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
    //         ], 422);
    //     }

    //     $validator = Validator::make(request()->all(), [
    //         'branch_id' => ['required'],
    //         'asset_category_id' => ['required'],
    //         'purchase_price' => ['required'],
    //         'name' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data->title = request()->title;
    //     $data->price = request()->price;
    //     $data->save();

    //     return response()->json($data, 200);
    // }
}
