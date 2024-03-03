<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Institute\InstituteClass;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassSubject;
use App\Models\Institute\InstituteStudent;
use Carbon\Carbon;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AttendenceController extends Controller
{
    // get the branch admin details from auth
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


    public function attendence_students()
    {
        
        $students = InstituteStudent::whereExists(
            function($query) {  
                $query->from('institute_branch_institute_student')
                    ->where('institute_branch_institute_student.institute_branch_id', $this->getBranchID())
                    ->whereColumn('institute_branch_institute_student.institute_student_id', 'institute_students.id');
            })->with(['user'])->get();
        
        return response()->json($students);

    }

    public function class_wise_batch()
    {
        $batches = InstituteClass::where('id', request()->class_id)
        ->where('branch_id', $this->getBranchID())
        ->with('batch')->first();

        return response()->json($batches);
    }

    public function single_student_attendence()
    {
        $attendence = Attendence::where('table_id', auth()->user()->id)
        ->where('table', "users")->with(['batch', 'class', 'subject', 'user'])
        ->get();
        return response()->json($attendence);
    }

    public function single_student_attendence_by_id($id) {
        $attendence = Attendence::where('table_id', $id)
        ->where('table', "users")->with(['batch', 'class', 'subject', 'user'])
        ->get();
        return response()->json($attendence);
    }

    public function student_monthly_attendence()
    {
        // dd(request()->all());
        $attendence = Attendence::where('table_id', auth()->user()->id)
        ->where('table', "users")->whereMonth('date', request()->month)->whereYear('date', request()->year)
        ->get();
        return response()->json($attendence);
    }

    // public function teacher_monthly_attendence()
    // {
    //     // dd(request()->all());
    //     $attendence = Attendence::where('table_id', auth()->user()->id)
    //     ->where('table', "employee")->whereMonth('date', request()->month)->whereYear('date', request()->year)
    //     ->get();
    //     return response()->json($attendence);
    // }

    public function get_subjects()
    {
        $batch = InstituteClassBatch::where('id', request()->batch_id)->first();
        $batch_subjects = InstituteClassBatch::where('id', request()->batch_id)->with(['subjects' => function($q2) use ($batch) {
            $q2->whereExists(
                function($query) use ($batch) {
                    $query->from('institute_class_batch_time_schedules')
                    ->where('institute_class_batch_time_schedules.institute_class_id', $batch->institute_class_id)
                    ->where('institute_class_batch_time_schedules.institute_class_batch_id', $batch->id)
                    ->whereColumn('institute_class_batch_time_schedules.institute_class_subject_id', 'institute_class_subjects.id');
                })->get();
        }])->first();

        $subjects = $batch_subjects->subjects;
        
        // $subjects = InstituteClassSubject::whereExists(
        //     function($query) use ($batch) {  
        //         $query->from('institute_class_institute_class_subject')
        //             ->where('institute_class_institute_class_subject.institute_class_id', $batch->institute_class_id)
        //             ->whereColumn('institute_class_institute_class_subject.institute_class_subject_id', 'institute_class_subjects.id');
        //     });
        
        // $subjects->whereExists(
        //     function($query) use ($batch) {
        //         $query->from('institute_class_batch_time_schedules')
        //         ->where('institute_class_batch_time_schedules.institute_class_id', $batch->institute_class_id)
        //         ->where('institute_class_batch_time_schedules.institute_class_batch_id', $batch->id)
        //         ->whereColumn('institute_class_batch_time_schedules.institute_class_subject_id', 'institute_class_subjects.id');
        //     });

        
        return response()->json($subjects);
    }

    public function batch_wise_students()
    {
       
        $date = Carbon::parse(request()->date)->toDateString();
        $students = InstituteClassBatch::join('institute_class_batch_institute_student', 'institute_class_batch_institute_student.institute_class_batch_id', '=', 'institute_class_batches.id')
        ->join('institute_students', 'institute_students.id', '=', 'institute_class_batch_institute_student.institute_student_id')
        ->join('users', 'users.id', '=', 'institute_students.user_id')
        ->leftJoin('attendences', function ($join) use ($date) {
            $join->on('attendences.table_id', '=', 'users.id')
                ->where('attendences.date', $date)
                ->where('attendences.subject_id', request()->subject_id)
                ->where('attendences.table', '=', 'users');
        })
        ->where('institute_class_batches.id', request()->batch_id)
        ->select('users.*', 'attendences.present', 'attendences.date')
        ->get();

        return response()->json($students);
    }

    public function student_attendence()
    {
        // dd(request()->all());
        if(request()->multiple == 1) {
            if(count(request()->student_id) > 0) {
                foreach (request()->student_id as $key => $student) {
                    $attendence_date = Carbon::parse(request()->attendence_date)->toDateString();
                    
                    $attendence_check = Attendence::where('table', 'users')
                    ->where('table_id', $student)
                    ->where('class_id', request()->class_id)
                    ->where('batch_id', request()->batch_id)
                    ->where('date', $attendence_date)
                    ->first();

                    if($attendence_check == null) {
                        $attendence = new Attendence();
                        $attendence->table = 'users';
                        $attendence->table_id = $student;
                        $attendence->class_id = request()->class_id;
                        $attendence->batch_id = request()->batch_id;
                        $attendence->subject_id = request()->subject_id;
                        $attendence->date = Carbon::parse(request()->attendence_date)->toDateString();
                        $attendence->present = request()->present;
                        $attendence->save();
                        
                    }else{
                        $attendence_check->table = 'users';
                        $attendence_check->table_id = $student;
                        $attendence_check->class_id = request()->class_id;
                        $attendence_check->batch_id = request()->batch_id;
                        $attendence_check->subject_id = request()->subject_id;
                        $attendence_check->date = Carbon::parse(request()->attendence_date)->toDateString();
                        $attendence_check->present = request()->present;
                        $attendence_check->save();
                    }
                }
                return response()->json("Attendence updated!", 200);
            }
        }
        $attendence_date = Carbon::parse(request()->attendence_date)->toDateString();
        
        $attendence = Attendence::where('table', 'users')
        ->where('table_id', request()->student_id)
        ->where('class_id', request()->class_id)
        ->where('batch_id', request()->batch_id)
        ->where('date', $attendence_date)
        ->first();

        if($attendence == null) {
            $attendence = new Attendence();
            $attendence->table = 'users';
            $attendence->table_id = request()->student_id;
            $attendence->class_id = request()->class_id;
            $attendence->batch_id = request()->batch_id;
            $attendence->subject_id = request()->subject_id;
            $attendence->date = Carbon::parse(request()->attendence_date)->toDateString();
            $attendence->present = request()->present;
            $attendence->save();
            
        }else{
            Attendence::where('table', 'users')
            ->where('table_id', request()->student_id)
            ->where('class_id', request()->class_id)
            ->where('batch_id', request()->batch_id)
            ->delete();
        }
        return response()->json("Attendence updated!", 200);
    }

    public function show($id)
    {
        $data = Attendence::where('id',$id)->with(['user'])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
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
