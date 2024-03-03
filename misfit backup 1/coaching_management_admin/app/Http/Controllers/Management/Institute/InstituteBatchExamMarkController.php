<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteClassBatchExam;
use App\Models\Institute\InstituteClassBatchExamMark;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class InstituteBatchExamMarkController extends Controller
{
    public function all()
    {

        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatchExamMark::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('date', $key)
                    ->orWhere('mark', $key)
                    ->orWhere('date', 'LIKE', '%' . $key . '%')
                    ->orWhere('mark', 'LIKE', '%' . $key . '%');
            });
        }

        $InstituteClasss = $query->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function exam_students($id)
    {

        $exam_students = InstituteClassBatchExam::where('id', $id)->with(['batch' => function($q) use ($id) {
            $q->with(['class', 'institute_students' => function($q2) use ($id) {
                $q2->leftJoin('institute_class_batch_exam_marks', function ($join) use ($id) {
                        $join->on('institute_students.user_id', '=', 'institute_class_batch_exam_marks.user_id')
                             ->on('institute_class_batch_exam_marks.institute_class_batch_exam_id', '=', DB::raw($id));
                    })
                    ->leftJoin('users', 'institute_students.user_id', '=', 'users.id')
                    ->select(
                        DB::raw('COALESCE(institute_class_batch_exam_marks.mark, "") AS mark'),
                        'users.*' 
                    );
            }]);
        }])->first();
        
       
        return response()->json($exam_students);
    }

    public function student_exam_result()
    {
        $student_results = InstituteClassBatchExamMark::where('user_id', auth()->user()->id)
        ->with(['exam_batch', 'exam' => function($query) {
            $query->with('subject');
        }])
        ->get();
        // dd($student_results);

        return response()->json($student_results);
    }

    public function single_student_exam_result($id) {
        $student_results = InstituteClassBatchExamMark::where('user_id', $id)
        ->with(['exam_batch', 'exam' => function($query) {
            $query->with('subject');
        }])
        ->get();

        return response()->json($student_results);
    }



    public function result_submit()
    {
        $exam_datas = InstituteClassBatchExam::where('id', request()->exam_id)->with(['batch'])->first();

        

        $date = Carbon::now()->toDateString();

        $data = InstituteClassBatchExamMark::where('institute_class_batch_exam_id', request()->exam_id)
        ->where('user_id', request()->user_id)->first();
        if($data && $data !== null) {
            $data->mark = request()->mark;
            $data->save();
        }else {
            $data = new InstituteClassBatchExamMark();
            $data->user_id = request()->user_id;
            $data->batch_id = $exam_datas->batch->id;
            $data->batch_class_id = $exam_datas->batch->institute_class_id;
            $data->institute_class_batch_exam_id = request()->exam_id;
            $data->date = $date;
            $data->mark = request()->mark;
            $data->save();
        }

        return response()->json([$data, "result updated"],200);
    }

    public function show($id)
    {
        $data = InstituteClassBatchExamMark::where('id',$id)->first();
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
            'batch_id' => ['required'],
            'batch_class_id' => ['required'],
            'institute_class_batch_exam_id' => ['required'],
            'date' => ['required'],
            'mark' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatchExamMark();
        $data->user_id = request()->user_id;
        $data->batch_id = request()->batch_id;
        $data->batch_class_id = request()->batch_class_id;
        $data->institute_class_batch_exam_id = request()->institute_class_batch_exam_id;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->mark = request()->mark;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'batch_id' => ['required'],
            'batch_class_id' => ['required'],
            'institute_class_batch_exam_id' => ['required'],
            'date' => ['required'],
            'mark' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatchExamMark();
        $data->user_id = request()->user_id;
        $data->batch_id = request()->batch_id;
        $data->batch_class_id = request()->batch_class_id;
        $data->institute_class_batch_exam_id = request()->institute_class_batch_exam_id;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->mark = request()->mark;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteClassBatchExamMark::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'batch_id' => ['required'],
            'batch_class_id' => ['required'],
            'institute_class_batch_exam_id' => ['required'],
            'date' => ['required'],
            'mark' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->batch_id = request()->batch_id;
        $data->batch_class_id = request()->batch_class_id;
        $data->institute_class_batch_exam_id = request()->institute_class_batch_exam_id;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->mark = request()->mark;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteClassBatchExamMark::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'user_id' => ['required'],
            'batch_id' => ['required'],
            'batch_class_id' => ['required'],
            'institute_class_batch_exam_id' => ['required'],
            'date' => ['required'],
            'mark' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_id = request()->user_id;
        $data->batch_id = request()->batch_id;
        $data->batch_class_id = request()->batch_class_id;
        $data->institute_class_batch_exam_id = request()->institute_class_batch_exam_id;
        $data->date = Carbon::parse(request()->date)->toDateString();
        $data->mark = request()->mark;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_class_batch_exam_marks,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteClassBatchExamMark::where('id', request()->id)->delete();

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
            
            $item = (object) $item;
            // dd(request()->data);
            $exam = InstituteClassBatchExam::where('institute_class_batch_id',$item->batch_id)->where('id',$item->exam_id)->with(['batch' => function($q) {
                $q->with(['class','institute_students' => function($q2) {
                    $q2->with(['user']);
                }]);
            }])->first();
            // dd($exam);
            if($exam){
                try {
                    
                    
                    $exam_mark = InstituteClassBatchExamMark::where('user_id', $item->user_id)->first();
                    
                    if($exam_mark && $exam_mark !== null) {
                        try {
                            $exam_mark->mark = $item->mark;
                            $exam_mark->update();
                        } catch (\Throwable $th) {
                            return response()->json([
                                'err_message' => 'validation error',
                                'errors' => $th->getMessage(),
                            ], 400);
                        }
                    }else {
                        $exam_mark = new InstituteClassBatchExamMark();
                        $exam_mark->user_id = $item->user_id;
                        $exam_mark->batch_id = $item->batch_id; 
                        $exam_mark->batch_class_id = $exam->batch->class->id;
                        $exam_mark->institute_class_batch_exam_id = $item->exam_id;
                        $exam_mark->date = Carbon::now()->toDateString();
                        $exam_mark->mark = $item->mark;
                        $exam_mark->save();
                    }

                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }else {
                return response()->json([
                    'err_message' => 'validation error',
                    'errors' => ['name'=>['Exam not found by given id'.(request()->exam_id?request()->exam_id:'null')]],
                ], 422);
            }
        }

        return response()->json('success', 200);
    }
}
