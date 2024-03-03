<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductStockLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductStockController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $status = 1;
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = ProductStock::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('product_id', $key)
                    ->orWhere('supplier_id', $key);
            });
        }

        $users = $query->with(['product', 'supplier'])->paginate($paginate);
        return response()->json($users);
    }

    public function show($id)
    {
        $data = ProductStock::where('id',$id)->with(['product', 'supplier'])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'selected_product' => ['required'],
            'selected_supplier' => ['required'],
            'qty' => ['required', 'numeric'],
            'purchase_date' => ['required', 'date']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        /* 
            First insert the qty data in product stock table
        */
        $data = new ProductStock();
        $data->supplier_id = request()->selected_supplier;
        $data->product_id = request()->selected_product; 
        $data->qty = request()->qty; 
        $data->purchase_date = Carbon::parse(request()->purchase_date)->toDateString();
        
        $data->save();

        /* 
            Insert the data in stock log table,
            type="sales" || insert when a product is ordered
            type="purchase" || inserted when a product is bought
        */

        $dataStock = new ProductStockLog();
        $dataStock->product_id = $data->product_id;
        $dataStock->qty = $data->qty; 
        $dataStock->type = "purchase"; 
        $dataStock->creator = Auth::user()->id; 
        $dataStock->save();

        return response()->json($data, 200);
    }

    public function update()
    {

        $validator = Validator::make(request()->all(), [
            'selected_product' => ['required'],
            'selected_supplier' => ['required'],
            'qty' => ['required'],
            'purchase_date' => ['required', 'date']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $stock_quantity = ProductStock::find(request()->id);
        if(request()->qty < -$stock_quantity->qty || request()->qty > 0) {
            
            return response()->json([
                'err_message' => 'Stock quantity cannot be less then the original stock',
                'err_type' => 'quantity_invalid'
            ], 400);
            
        }else {
            
            /* 
            First insert the qty data in product stock table
            */
            $data = new ProductStock();
            $data->supplier_id = request()->selected_supplier[0];
            $data->product_id = request()->selected_product[0]; 
            $data->qty = request()->qty; 
            $data->purchase_date = Carbon::parse(request()->purchase_date)->toDateString();
            $data->save();

            /* 
                Insert the data in stock log table,
                type="sales" || insert when a product is ordered
                type="purchase" || inserted when a 
            */

            $dataStock = new ProductStockLog();
            $dataStock->product_id = $data->product_id;
            $dataStock->qty = $data->qty; 
            $dataStock->type = "purchase"; 
            $dataStock->creator = Auth::user()->id; 
            $dataStock->save();

            return response()->json($data, 200);
        }
        
    }
}
