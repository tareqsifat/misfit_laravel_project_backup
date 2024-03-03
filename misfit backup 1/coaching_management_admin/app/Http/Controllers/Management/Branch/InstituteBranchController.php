<?php

namespace App\Http\Controllers\Management\Branch;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstituteBranchController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;


        $query = InstituteBranch::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('name', $key)
                    ->orWhere('city', $key)
                    ->orWhere('zip_code', $key)
                    ->orWhere('name', 'LIKE', '%' . $key . '%')
                    ->orWhere('city', 'LIKE', '%' . $key . '%')
                    ->orWhere('street', 'LIKE', '%' . $key . '%')
                    ->orWhere('country', 'LIKE', '%' . $key . '%')
                    ->orWhere('zip_code', 'LIKE', '%' . $key . '%');
            });
        }

        $users = $query->paginate($paginate);
        return response()->json($users);
    }

    public function show($id)
    {
        $data = InstituteBranch::where('id',$id)->first();
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
        $validator = InstituteBranch::make(request()->all(), [
            'name' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteBranch();
        $data->name = request()->name;
        $data->street = request()->street;
        $data->city = request()->city;
        $data->state = request()->state;
        $data->zip_code = request()->zip_code;
        $data->country = request()->country;
        $data->creator = Auth::user()->id;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = InstituteBranch::make(request()->all(), [
            'name' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteBranch();
        $data->name = request()->name;
        $data->street = request()->street;
        $data->city = request()->city;
        $data->state = request()->state;
        $data->zip_code = request()->zip_code;
        $data->country = request()->country;
        $data->creator = Auth::user()->id;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteBranch::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = InstituteBranch::make(request()->all(), [
            'name' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->name = request()->name;
        $data->street = request()->street;
        $data->city = request()->city;
        $data->state = request()->state;
        $data->zip_code = request()->zip_code;
        $data->country = request()->country;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteBranch::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['asset not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = InstituteBranch::make(request()->all(), [
            'name' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->name = request()->name;
        $data->street = request()->street;
        $data->city = request()->city;
        $data->state = request()->state;
        $data->zip_code = request()->zip_code;
        $data->country = request()->country;
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

        $data = InstituteBranch::find(request()->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
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

        $data = InstituteBranch::where('id', request()->id)->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
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

        $data = InstituteBranch::find(request()->id);
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
            $check = InstituteBranch::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteBranch::create((array) $item);
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
