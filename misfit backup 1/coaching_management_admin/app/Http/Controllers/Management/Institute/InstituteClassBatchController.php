<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteClassBatch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituteClassBatchController extends Controller
{
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        if(count($branch_admin->branch_admin) > 0) {
            return $branch_admin->branch_admin[0]->branch_details->id;
        }else {
            $branch_user = auth()->user()->load('branch_user');
            $branch_id = $branch_user->branch_user[0]->id;
            return $branch_id;
        }
    }
    public function all()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatch::where('branch_id', $this->getBranchID())->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('name', $key)
                    ->orWhere('name', 'LIKE', '%' . $key . '%');
            });
        }

        $InstituteClasss = $query->with(['class'])->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function admin_batchs() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatch::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('name', $key)
                    ->orWhere('name', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('branch_id')) {
            $query = $query->where('branch_id', request()->branch_id);
        }

        $InstituteClasss = $query->with(['class', 'branch'])->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function admin_show($id)
    {
        $data = InstituteClassBatch::where('id',$id)->with(['class'])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function batch_subjects($id)  {
        $subjects = InstituteClassBatch::where('id', $id)->with(['subjects', 'class'])->first();

        return response()->json($subjects);
    }

    public function show($id)
    {
        $data = InstituteClassBatch::where('id',$id)->where('branch_id', $this->getBranchID())->with(['class'])->first();
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
            'name' => ['required'],
            'institute_class_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatch();
        $data->name = request()->name;
        $data->institute_class_id = request()->institute_class_id;
        $data->branch_id = $this->getBranchID();
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'institute_class_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatch();
        $data->name = request()->name;
        $data->institute_class_id = request()->institute_class_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteClassBatch::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'institute_class_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->name = request()->name;
        $data->institute_class_id = request()->institute_class_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteClassBatch::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'institute_class_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->name = request()->name;
        $data->institute_class_id = request()->institute_class_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_class_batches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteClassBatch::where('id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
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
            $check = InstituteClassBatch::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteClassBatch::create((array) $item);
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
