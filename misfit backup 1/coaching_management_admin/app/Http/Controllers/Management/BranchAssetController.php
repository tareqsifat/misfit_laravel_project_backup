<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Asset\BranchAsset;
use App\Models\Institute\InstituteBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchAssetController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = BranchAsset::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('purchase_price', $key)
                    ->orWhere('name', $key)
                    ->orWhere('name', 'LIKE', '%' . $key . '%')
                    ->orWhere('details', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('branch_id')) {
            $query = $query->where('branch_id', request()->branch_id);
        }

        $users = $query->with(['branch'])->paginate($paginate);
        return response()->json($users);
    }

    public function get_all_branches()
    {
        $branches = InstituteBranch::where('status', 1)->get();

        return response()->json($branches);
    }

    public function show($id)
    {
        $data = BranchAsset::where('id',$id)->first();
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
            'branch_id' => ['required'],
            'purchase_price' => ['required'],
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BranchAsset();
        $data->branch_id = request()->branch_id;
        // $data->asset_category_id = request()->asset_category_id;
        $data->purchase_price = request()->purchase_price;
        $data->buying_date = request()->buying_date;
        $data->name = request()->name;
        $data->depreciation_price = request()->depreciation_price;
        $data->details = request()->details;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'branch_id' => ['required'],
            'asset_category_id' => ['required'],
            'purchase_price' => ['required'],
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BranchAsset();
        $data->branch_id = request()->branch_id;
        $data->asset_category_id = request()->asset_category_id;
        $data->purchase_price = request()->purchase_price;
        $data->buying_date = request()->buying_date;
        $data->name = request()->name;
        $data->depreciation_price = request()->depreciation_price;
        $data->details = request()->details;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = BranchAsset::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'branch_id' => ['required'],
            'asset_category_id' => ['required'],
            'purchase_price' => ['required'],
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->branch_id = request()->branch_id;
        $data->asset_category_id = request()->asset_category_id;
        $data->purchase_price = request()->purchase_price;
        $data->name = request()->name;
        $data->depreciation_price = request()->depreciation_price;
        $data->details = request()->details;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = BranchAsset::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'branch_id' => ['required'],
            'asset_category_id' => ['required'],
            'purchase_price' => ['required'],
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->branch_id = request()->branch_id;
        $data->asset_category_id = request()->asset_category_id;
        $data->purchase_price = request()->purchase_price;
        $data->name = request()->name;
        $data->depreciation_price = request()->depreciation_price;
        $data->details = request()->details;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_branches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BranchAsset::find(request()->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_branches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BranchAsset::find(request()->id);
        $data->status = 1;
        $data->save();

        return response()->json([
                'result' => 'activated',
        ], 200);
    }

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
            $check = BranchAsset::where('id',$item->id)->first();
            if(!$check){
                try {
                    BranchAsset::create((array) $item);
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
