<?php

namespace App\Http\Controllers\Management\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\CrmCallHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerCallController extends Controller
{
    public function all()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = CrmCallHistory::with(['topic', 'customer'])->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('feedback', $key)
                    ->orWhere('feedback', 'LIKE', '%' . $key . '%');
            });
        }

        $CrmCallHistorys = $query->paginate($paginate);
        return response()->json($CrmCallHistorys);
    }

    public function show($id)
    {
        $data = CrmCallHistory::with(['topic', 'customer'])->where('id',$id)->first();
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
            'topic_id' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CrmCallHistory();
        $data->topic_id = request()->topic_id;
        $data->customer_id = request()->customer_id;
        $data->feedback = request()->feedback;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'topic_id' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CrmCallHistory();
        $data->topic_id = request()->topic_id;
        $data->customer_id = request()->customer_id;
        $data->feedback = request()->feedback;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CrmCallHistory::where('id',request()->id)->with(['topic', 'customer'])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['CrmCallHistory not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'topic_id' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->topic_id = request()->topic_id;
        $data->customer_id = request()->customer_id;
        $data->feedback = request()->feedback;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CrmCallHistory::where('id',request()->id)->with(['topic', 'customer'])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['CrmCallHistory not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'topic_id' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->topic_id = request()->topic_id;
        $data->customer_id = request()->customer_id;
        $data->feedback = request()->feedback;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:crm_call_histories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CrmCallHistory::where('id', request()->id)->delete();

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
            $check = CrmCallHistory::where('id',$item->id)->first();
            if(!$check){
                try {
                    CrmCallHistory::create((array) $item);
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
