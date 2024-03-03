<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendenceController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Attendence::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('date', $key)
                    ->orWhere('time', 'LIKE', '%' . $key . '%')
                    ->orWhere('date', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with('user')->paginate($paginate);
        return response()->json($users);
    }

    public function admin_student_attendence()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Attendence::where('table', 'users')->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('date', $key)
                    ->orWhere('time', 'LIKE', '%' . $key . '%')
                    ->orWhere('date', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with('user')->paginate($paginate);
        return response()->json($users);
    }

    public function admin_employee_attendence()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = Attendence::where('table', 'employee')->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('date', $key)
                    ->orWhere('time', 'LIKE', '%' . $key . '%')
                    ->orWhere('date', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->with('user')->paginate($paginate);
        return response()->json($users);
    }

    public function show($id)
    {
        $data = Attendence::where('id',$id)->with('user')->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function admin_show($id)
    {
        $data = Attendence::where('id',$id)->with('user')->first();
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
            'user_id' => ['required'],
            'time' => ['required'],
            'date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Attendence();
        $data->user_id = request()->user_id;
        $data->time = Carbon::parse(request()->time)->format('H:i:s');
        $data->date = Carbon::parse(request()->date);
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = Attendence::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['category not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'time' => ['required'],
            'date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->time = Carbon::parse(request()->time)->format('H:i:s');
        $data->date = Carbon::parse(request()->date);
        $data->save();

        return response()->json($data, 200);
    }


    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:user_attendences,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Attendence::where('id',request()->id)->delete();

        return response()->json([
            'result' => 'Deleted successfully',
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
            $check = Attendence::where('id',$item->id)->first();
            if(!$check){
                try {
                    Attendence::create((array) $item);
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
