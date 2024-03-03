<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteClassSubject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituteClassSubjectController extends Controller
{

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

        $query = InstituteClassSubject::where('branch_id', $this->getBranchID())->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%');
            });
        }

        $InstituteClasss = $query->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function admin_subjects() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassSubject::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('branch_id')) {
            $query = $query->where('branch_id', request()->branch_id);
        }

        $InstituteClasss = $query->with(['branch'])->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function admin_show($id)
    {
        $data = InstituteClassSubject::where('id',$id)->with(['branch'])->first();
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
        $data = InstituteClassSubject::where('id',$id)->where('branch_id', $this->getBranchID())->first();
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
        if (request()->has('subjects')) {
            $subjects = json_decode(request()->subjects);
            foreach ($subjects as $key => $sub) {
                if(empty($sub->title)) {
                    return response()->json([
                        'err_message' => 'subject name is empty',
                    ], 422);
                }else {
                    if (isset($sub->id)) {
                        $data = InstituteClassSubject::where('id',$sub->id)->first();
                        if($data == null) {
                            $data = new InstituteClassSubject();
                            $data->title = $sub->title;
                            $data->branch_id = $this->getBranchID();
                            $data->save();
                            $data->subject_id = $data->id;
                            $data->save();
                            $data->batch()->attach([request()->batch_id]);
                        }
                        else {
                            $data->title = $sub->title;
                            $data->branch_id = $this->getBranchID();
                            $data->save();
                            $data->batch()->sync([request()->batch_id]);
                        }
                    }
                    else {
                        $data = new InstituteClassSubject();
                        $data->title = $sub->title;
                        $data->branch_id = $this->getBranchID();
                        $data->save();
                        $data->subject_id = $data->id;
                        $data->save();
                        $data->batch()->attach([request()->batch_id]);
                    }
                }
            }
            return response()->json($data, 200);
        }
        
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassSubject();
        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteClassSubject::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->branch_id = $this->getBranchID();
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteClassSubject::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_class_subjects,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteClassSubject::where('id', request()->id)->first();

        $data->institute_class()->detach();
        $data->delete();

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
            $check = InstituteClassSubject::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteClassSubject::create((array) $item);
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
