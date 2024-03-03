<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteBranch;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchExam;
use App\Models\Institute\InstituteTeacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituteBatchExamController extends Controller
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

        $query = InstituteClassBatchExam::where('branch_id', $this->getBranchID())->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('exam_title', $key)
                    ->orWhere('exam_title', 'LIKE', '%' . $key . '%');
            });
        }

        $InstituteClasss = $query->with(['subject', 'batch' => function($q) {
            $q->with(['class']);
        }])->paginate($paginate);

        return response()->json($InstituteClasss);
    }

    public function admin_exams() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatchExam::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('exam_title', $key)
                    ->orWhere('exam_title', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('branch_id')) {
            $query = $query->where('branch_id', request()->branch_id);
        }

        $InstituteClasss = $query->with(['subject', 'branch', 'batch' => function($q) {
            $q->with('class');
        }])->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function admin_show($id) : object {
        $data = InstituteClassBatchExam::where('id',$id)->with(['subject', 'batch' => function($q) {
            $q->with('class');
        }])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function exam_of_teacher()
    {
        $paginate = (int) request()->paginate;

        $exam_query = [];
        $teacher = InstituteTeacher::where('user_id', auth()->user()->id)
        ->with(['batch' => function($q) {
            $q->with(['class', 'exams' => function($q2) { $q2->with('subject'); }]);
        }])->first();

        $temp_array = [];
        foreach ($teacher->batch as $key => $item_batch) {
            $temp_array['batch_name'] = $item_batch->name;
            $temp_array['class_name'] = $item_batch->class->title;
            foreach ($item_batch->exams as $key => $exam) {
                $temp_array['id'] = $exam->id;
                $temp_array['exam_title'] = $exam->exam_title;
                $temp_array['subject'] = $exam->subject->title;
                $temp_array['created_at'] = $exam->created_at;
                
                array_push($exam_query, $temp_array);
            }
        }

        $exams = (object)$exam_query;
        $exams = collect($exams);
        $exams = $exams->paginate(15);

        return response()->json($exams);
    }

    public function show($id)
    {
        $data = InstituteClassBatchExam::where('id',$id)->with(['subject', 'batch' => function($q) {
            $q->with('class');
        }])->first();
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
            'institute_class_batch_id' => ['required'],
            'subject_id' => ['required'],
            'exam_title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatchExam();
        $data->institute_class_batch_id = request()->institute_class_batch_id;
        $data->branch_id = $this->getBranchID();
        $data->subject_id = request()->subject_id;
        $data->exam_title = request()->exam_title;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'institute_class_batch_id' => ['required'],
            'subject_id' => ['required'],
            'exam_title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatchExam();
        $data->institute_class_batch_id = request()->institute_class_batch_id;
        $data->branch_id = $this->getBranchID();
        $data->subject_id = request()->subject_id;
        $data->exam_title = request()->exam_title;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteClassBatchExam::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'institute_class_batch_id' => ['required'],
            'subject_id' => ['required'],
            'exam_title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->institute_class_batch_id = request()->institute_class_batch_id;
        $data->branch_id = $this->getBranchID();
        $data->subject_id = request()->subject_id;
        $data->exam_title = request()->exam_title;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteClassBatchExam::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'institute_class_batch_id' => ['required'],
            'subject_id' => ['required'],
            'exam_title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->institute_class_batch_id = request()->institute_class_batch_id;
        $data->subject_id = request()->subject_id;
        $data->branch_id = $this->getBranchID();
        $data->exam_title = request()->exam_title;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_class_batch_exams,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteClassBatchExam::where('id', request()->id)->delete();

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
            $check = InstituteClassBatchExam::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteClassBatchExam::create((array) $item);
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
