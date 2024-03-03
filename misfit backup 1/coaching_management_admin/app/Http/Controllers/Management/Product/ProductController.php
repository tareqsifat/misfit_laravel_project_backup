<?php

namespace App\Http\Controllers\Management\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductStockLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Product::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('price', 'LIKE', '%' . $key . '%');
            });
        }
        $query->withSum(['purchase_stock' => function ($q) {
            $q->where('type', 'initial')->orWhere('type', 'purchase')->orWhere('type', 'return');
        }], 'qty');

        $query->withSum(['sell_stock' => function ($q) {
            $q->where('type', 'sell');
        }], 'qty');
        $users = $query->with(['discount'])->paginate($paginate);
        return response()->json($users);
    }

    function update_stock() {
        $product = Product::where('id', request()->product_id)->first();
        if($product != null) {
            // $this->product_stock_set(null, $product->id, $product->created_at, request()->product_stock);
            $this->product_stock_log_set($product->id, request()->stock, request()->stock_type);

            return response()->json([
                'message' => 'stock updated successfully',
            ], 200);
        }else {
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['product'=>['data not found']],
            ], 422);
        }
    }

    public function show($id)
    {
        $data = Product::where('id',$id)->with('discount')->first();
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
            'title' => ['required', 'string'],
            'price' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $data = new Product();
        $data->title = request()->title;
        $data->price = request()->price;
        $data->save();

        $this->product_stock_set(null, $data->id, $data->created_at, request()->stock);
        $this->product_stock_log_set($data->id, request()->stock, 'initial');

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/product/product-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            // Storage::put($path, $file);
            Image::make($file)->fit(200, 200)->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'price' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $data = new Product();
        $data->title = request()->title;
        $data->price = request()->price;
        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/product/product-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->fit(200, 200)->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = Product::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['product not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'string'],
            'price' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->price = request()->price;
        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/product/product-' . $data->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->fit(200, 200)->save(public_path($path));
            $data->photo = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function product_stock_set($supplier_id = null, $product_id, $purchase_date, $qty)
    {
        ProductStock::create([
            'supplier_id' => $supplier_id,
            'product_id' => $product_id,
            'date' => $purchase_date,
            'qty' => $qty,
        ]);
    }

    public function product_stock_log_set($product_id, $qty, $type)
    {
        ProductStockLog::create([
            'product_id' => $product_id,
            'qty' => $qty,
            'type' => $type,
            'creator' => auth()->user()->id,
        ]);
    }

    // public function soft_delete()
    // {
    //     $validator = Validator::make(request()->all(), [
    //         'id' => ['required','exists:institute_branches,id'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = Product::find(request()->id);
    //     $data->status = 0;
    //     $data->save();

    //     return response()->json([
    //         'result' => 'deactivated',
    //     ], 200);
    // }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:products,id'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Product::where('id',request()->id)->delete();

        return response()->json([
            'result' => 'Deleted successfully!',
        ], 200);
    }

    // public function restore()
    // {
    //     $validator = Validator::make(request()->all(), [
    //         'id' => ['required','exists:institute_branches,id'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = Product::find(request()->id);
    //     $data->status = 1;
    //     $data->save();

    //     return response()->json([
    //             'result' => 'activated',
    //     ], 200);
    // }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required','array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']): Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']): Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = Product::where('id',$item->id)->first();
            if(!$check){
                try {
                    Product::create((array) $item);
                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }
        }

        return response()->json('success', 200);
    }
}
