<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveApplicationController extends Controller
{
    public $branch_admin;

    // get the branch admin details from auth
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        return $branch_admin->branch_admin[0]->branch_details->id;
    }

    public function all()
    {
       
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = LeaveApplication::where('branch_id', $this->getBranchID())->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('from_date', $key)
                    ->orWhere('to_date', $key)
                    ->orWhere('duration', $key)
                    ->orWhere('from_date', 'LIKE', '%' . $key . '%')
                    ->orWhere('duration', 'LIKE', '%' . $key . '%')
                    ->orWhere('to_date', 'LIKE', '%' . $key . '%');
            });
        }

        $LeaveApplications = $query->with(['user'])->paginate($paginate);
        return response()->json($LeaveApplications);
    }

    public function admin_leaves() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = LeaveApplication::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('from_date', $key)
                    ->orWhere('to_date', $key)
                    ->orWhere('duration', $key)
                    ->orWhere('from_date', 'LIKE', '%' . $key . '%')
                    ->orWhere('duration', 'LIKE', '%' . $key . '%')
                    ->orWhere('to_date', 'LIKE', '%' . $key . '%');
            });
        }

        $LeaveApplications = $query->with(['user'])->paginate($paginate);
        return response()->json($LeaveApplications);
    }

    public function admin_show($id)
    {
        $data = LeaveApplication::where('id',$id)->with('user')->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function show($id)
    {
        $data = LeaveApplication::where('id',$id)->where('branch_id', $this->getBranchID())->with('user')->first();
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
            'reason' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new LeaveApplication();
        $data->user_id = request()->user_id;
        $data->branch_id = $this->getBranchID();
        $data->reason = request()->reason;
        $data->from_date = Carbon::parse(request()->from_date)->toDateString();
        $data->to_date = Carbon::parse(request()->to_date)->toDateString();
        $data->duration = request()->duration;
        $data->creator = auth()->user()->id;
        $data->status = request()->status;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'reason' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new LeaveApplication();
        $data->user_id = request()->user_id;
        $data->branch_id = $this->getBranchID();
        $data->reason = request()->reason;
        $data->from_date = Carbon::parse(request()->from_date)->toDateString();
        $data->to_date = Carbon::parse(request()->to_date)->toDateString();
        $data->duration = request()->duration;
        $data->creator = auth()->user()->id;
        $data->status = request()->status;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = LeaveApplication::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['LeaveApplication not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'reason' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->branch_id = $this->getBranchID();
        $data->reason = request()->reason;
        $data->from_date = Carbon::parse(request()->from_date)->toDateString();
        $data->to_date = Carbon::parse(request()->to_date)->toDateString();
        $data->duration = request()->duration;
        $data->creator = auth()->user()->id;
        $data->status = request()->status;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = LeaveApplication::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['LeaveApplication not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'reason' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->branch_id = $this->getBranchID();
        $data->reason = request()->reason;
        $data->from_date = Carbon::parse(request()->from_date)->toDateString();
        $data->to_date = Carbon::parse(request()->to_date)->toDateString();
        $data->duration = request()->duration;
        $data->creator = auth()->user()->id;
        $data->status = request()->status;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:leave_applications,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = LeaveApplication::where('id', request()->id)->delete();

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
            $check = LeaveApplication::where('id',$item->id)->first();
            if(!$check){
                try {
                    LeaveApplication::create((array) $item);
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
