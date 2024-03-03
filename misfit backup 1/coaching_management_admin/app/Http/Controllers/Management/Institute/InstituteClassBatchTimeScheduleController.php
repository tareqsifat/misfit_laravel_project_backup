<?php

namespace App\Http\Controllers\Management\Institute;

use App\Http\Controllers\Controller;
use App\Models\Institute\InstituteBranch;
use App\Models\Institute\InstituteClass;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchTimeSchedule;
use App\Models\Institute\InstituteStudent;
use App\Models\Institute\InstituteTeacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstituteClassBatchTimeScheduleController extends Controller
{
    private function getBranchID() {
        $branch_admin = auth()->user()->load('branch_admin');
        
        if(count($branch_admin->branch_admin) > 0) {
            return $branch_admin->branch_admin[0]->branch_details->id;
        }else {
            $branch_user = auth()->user()->load('branch_user');
            
            if($branch_user != null && count($branch_admin->branch_admin) > 0) {
                $branch_id = $branch_user->branch_user[0]->id;
                return $branch_id;
            }
        }
    }
    public function all()
    {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatchTimeSchedule::where('branch_id', $this->getBranchID())
        ->with(['batch','class','subject','teacher' => function($q) {
            return $q->with('user');
        }])->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('day', $key)
                    ->orWhere('room', $key)
                    ->orWhere('start_time', 'LIKE', '%' . $key . '%')
                    ->orWhere('end_time', 'LIKE', '%' . $key . '%')
                    ->orWhere('day', 'LIKE', '%' . $key . '%')
                    ->orWhere('room', 'LIKE', '%' . $key . '%');
            });
        }

        $InstituteClasss = $query->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    public function filter_routines_by_date() {
        // Carbon::createFromFormat('m/d/Y', $myDate)->format('l');
        if(request()->branch_id == null){
            $branch_id = $this->getBranchID();
        }else {
            $branch_id = request()->branch_id;
        }
        $day = Carbon::parse(request()->date)->format('l');
        // dd($day, $branch_id);
        $routines = InstituteClassBatchTimeSchedule::where('branch_id', $branch_id)
        ->where('day', 'LIKE', '%' . $day . '%')
        ->with(['batch','class','subject','teacher' => function($q) {
            return $q->with('user');
        }])
        ->get();

        return response()->json($routines);
    }

    public function admin_schedules() : object {
        $paginate = (int) request()->paginate;
        $orderBy = request()->orderBy;
        $orderByType = request()->orderByType;

        $query = InstituteClassBatchTimeSchedule::with(['batch','class', 'branch','subject','teacher' => function($q) {
            return $q->with('user');
        }])->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('day', $key)
                    ->orWhere('room', $key)
                    ->orWhere('time', 'LIKE', '%' . $key . '%')
                    ->orWhere('day', 'LIKE', '%' . $key . '%')
                    ->orWhere('room', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('branch_id')){
            $query = $query->where('branch_id', request()->branch_id);
        } 
        

        $InstituteClasss = $query->paginate($paginate);
        return response()->json($InstituteClasss);
    }

    // get the scheules of the specific teacher 
    public function teacher_wise_batch_time_by_id($teacher_id) {
        $teacher = InstituteTeacher::where('id', $teacher_id)->with(['user' => function($q1) {
            $q1->with('branch_user');
        }])->first();
        
        $branch_id = $teacher->user->branch_user[0]->id;

        
        $classArray = [];
        $all_class = InstituteClass::where('branch_id', $branch_id)->get();
        foreach ($all_class as $key => $class_item) {
            $temp_array = [];
            $temp_array = $class_item;
            $class_batch = InstituteClassBatch::where('institute_class_id', $class_item->id)->with(['subjects'])->get();
            
            $class_item['batch'] = $class_batch;
            

            array_push($classArray, $temp_array); 
        }
        
        $scheduleArray = [];
        $class_rowspan = 0;
        $batch_rowspan = 0;

        foreach ($classArray as $key => $newclassItem) {
            
            $temp_array = [];
            $temp_array['class_name'] = $newclassItem->title;

            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                $class_rowspan += $batchItem->subjects->count();
            }
            // $temp_array['class_rowspan'] = $class_rowspan;


            foreach ($newclassItem->batch as $batchkey => $batchItem) {

                $temp_array['batch_name'] = $batchItem->name . $batchItem->id;
                $temp_array['batch_name_only'] = $batchItem->name;
                foreach ($batchItem->subjects as $subjectKey => $subjectItem) {
                    
                    if($subjectKey == 0) {
                        $temp_array['class_rowspan'] = $batchItem->subjects->count();
                        $temp_array['batch_rowspan'] =  $batchItem->subjects->count();
                    }
                    if($subjectKey > 0 ){
                        $temp_array['class_rowspan'] = 0;
                        $temp_array['batch_rowspan'] = 0;
                    }
                    $temp_array['subject_name'] = $subjectItem->title;

                    $temp_array['saturday_time'] = "";
                    $temp_array['saturday_room'] = "";
                    $temp_array['sunday_time'] = "";
                    $temp_array['sunday_room'] = "";
                    $temp_array['monday_time'] = "";
                    $temp_array['monday_room'] = "";
                    $temp_array['tuesday_time'] = "";
                    $temp_array['tuesday_room'] = "";
                    $temp_array['wednesday_time'] = "";
                    $temp_array['wednesday_room'] = "";
                    $temp_array['thursday_time'] = "";
                    $temp_array['thursday_room'] = "";
                    $temp_array['friday_time'] = "";
                    $temp_array['friday_room'] = "";
                    $checknull = true;
                    
                    $all_routine_schedules = $this->get_seven_day_schedules_teacher($newclassItem->id, $batchItem->id, $subjectItem->id, $teacher->id);
                    $check_is_schedule_has_null = $this->get_check_is_schedule_has_null($all_routine_schedules);
                    $checknull = $check_is_schedule_has_null["check_null"];

                    foreach ($check_is_schedule_has_null["day_schedule"] as $day_name => $day_data) {
                        foreach ($day_data as $day_key => $day_value) {
                            $temp_array[$day_key] = $day_value; 
                        }
                    }
                    
                    if(!$checknull) {
                        array_push($scheduleArray, $temp_array);
                    }
                }
                // dd('some');
            }
                
            $class_rowspan = 0;
        }

        foreach ($scheduleArray as $key => $class) {
            if($class["class_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["class_name"] == $class["class_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["class_rowspan"] = $row_count;
            }

            if($class["batch_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["batch_name"] == $class["batch_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["batch_rowspan"] = $row_count;
            }
        }

        return response()->json($scheduleArray);
    }

    // get the schedules of the authenticated teacher
    public function teacher_wise_batch_time()
    {
        $auth_with_branch = auth()->user()->load('branch_user');
        
        $branch_id = $auth_with_branch->branch_user[0]->id;

        
        $classArray = [];
        $all_class = InstituteClass::where('branch_id', $branch_id)->get();
        foreach ($all_class as $key => $class_item) {
            $temp_array = [];
            $temp_array = $class_item;
            $class_batch = InstituteClassBatch::where('institute_class_id', $class_item->id)->with(['subjects'])->get();
            
            $class_item['batch'] = $class_batch;
            

            array_push($classArray, $temp_array); 
        }
        
        $scheduleArray = [];
        $class_rowspan = 0;
        $batch_rowspan = 0;

        foreach ($classArray as $key => $newclassItem) {
            
            $temp_array = [];
            $temp_array['class_name'] = $newclassItem->title;

            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                $class_rowspan += $batchItem->subjects->count();
            }
            // $temp_array['class_rowspan'] = $class_rowspan;


            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                

                $temp_array['batch_name'] = $batchItem->name . $batchItem->id;
                $temp_array['batch_name_only'] = $batchItem->name;
                foreach ($batchItem->subjects as $subjectKey => $subjectItem) {
                    
                    if($subjectKey == 0) {
                        $temp_array['class_rowspan'] = $batchItem->subjects->count();
                        $temp_array['batch_rowspan'] =  $batchItem->subjects->count();
                    }
                    if($subjectKey > 0 ){
                        $temp_array['class_rowspan'] = 0;
                        $temp_array['batch_rowspan'] = 0;
                    }
                    $temp_array['subject_name'] = $subjectItem->title;

                    $temp_array['saturday_time'] = "";
                    $temp_array['saturday_room'] = "";
                    $temp_array['sunday_time'] = "";
                    $temp_array['sunday_room'] = "";
                    $temp_array['monday_time'] = "";
                    $temp_array['monday_room'] = "";
                    $temp_array['tuesday_time'] = "";
                    $temp_array['tuesday_room'] = "";
                    $temp_array['wednesday_time'] = "";
                    $temp_array['wednesday_room'] = "";
                    $temp_array['thursday_time'] = "";
                    $temp_array['thursday_room'] = "";
                    $temp_array['friday_time'] = "";
                    $temp_array['friday_room'] = "";
                    $checknull = true;
                    $teacher_id = InstituteTeacher::where('user_id', auth()->user()->id)->pluck('id')->first();
                    $all_routine_schedules = $this->get_seven_day_schedules_teacher($newclassItem->id, $batchItem->id, $subjectItem->id, $teacher_id);
                    $check_is_schedule_has_null = $this->get_check_is_schedule_has_null($all_routine_schedules);
                    $checknull = $check_is_schedule_has_null["check_null"];

                    foreach ($check_is_schedule_has_null["day_schedule"] as $day_name => $day_data) {
                        foreach ($day_data as $day_key => $day_value) {
                            $temp_array[$day_key] = $day_value; 
                        }
                    }
                    
                    if(!$checknull) {
                        array_push($scheduleArray, $temp_array);
                    }
                }
                // dd('some');
            }
                
            $class_rowspan = 0;
        }

        foreach ($scheduleArray as $key => $class) {
            if($class["class_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["class_name"] == $class["class_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["class_rowspan"] = $row_count;
            }

            if($class["batch_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["batch_name"] == $class["batch_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["batch_rowspan"] = $row_count;
            }
        }

        return response()->json($scheduleArray);
    }

    // get the schedules of the authenticated student
    public function student_wise_batch_time() {
        
        $auth_with_branch = auth()->user()->load('branch_user');
        
        $branch_id = $auth_with_branch->branch_user[0]->id;
        $student_id = InstituteStudent::where('user_id', auth()->user()->id)->pluck('id')->first();
        $classArray = [];
        $all_class = InstituteClass::where('branch_id', $branch_id)->get();
        foreach ($all_class as $key => $class_item) {
            $temp_array = [];
            $temp_array = $class_item;
            $class_batch = InstituteClassBatch::where('institute_class_id', $class_item->id)->with(['subjects'])->get();
            
            $class_item['batch'] = $class_batch;
            

            array_push($classArray, $temp_array); 
        }
        
        $scheduleArray = [];
        $class_rowspan = 0;
        $batch_rowspan = 0;

        foreach ($classArray as $key => $newclassItem) {
            
            $temp_array = [];
            $temp_array['class_name'] = $newclassItem->title;

            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                $class_rowspan += $batchItem->subjects->count();
            }
            // $temp_array['class_rowspan'] = $class_rowspan;


            foreach ($newclassItem->batch as $batchkey => $batchItem) {

                $temp_array['batch_name'] = $batchItem->name;
                $batch_students = $batchItem->institute_students;
                
                foreach ($batch_students as $key => $batch_student) {
                    
                    if($batch_student->id == $student_id) {
                        
                        foreach ($batchItem->subjects as $subjectKey => $subjectItem) {
                            if($subjectKey == 0) {
                                $temp_array['class_rowspan'] = $batchItem->subjects->count();
                                $temp_array['batch_rowspan'] =  $batchItem->subjects->count();
                            }
                            if($subjectKey > 0 ){
                                $temp_array['class_rowspan'] = 0;
                                $temp_array['batch_rowspan'] = 0;
                            }
                            $temp_array['subject_name'] = $subjectItem->title;
        
                            $temp_array['saturday_time'] = "";
                            $temp_array['saturday_room'] = "";
                            $temp_array['sunday_time'] = "";
                            $temp_array['sunday_room'] = "";
                            $temp_array['monday_time'] = "";
                            $temp_array['monday_room'] = "";
                            $temp_array['tuesday_time'] = "";
                            $temp_array['tuesday_room'] = "";
                            $temp_array['wednesday_time'] = "";
                            $temp_array['wednesday_room'] = "";
                            $temp_array['thursday_time'] = "";
                            $temp_array['thursday_room'] = "";
                            $temp_array['friday_time'] = "";
                            $temp_array['friday_room'] = "";
                            $checknull = true;
                            
                            $all_routine_schedules = $this->get_seven_day_schedules($newclassItem->id, $batchItem->id, $subjectItem->id);
                            
                            $check_is_schedule_has_null = $this->get_check_is_schedule_has_null($all_routine_schedules);
                            $checknull = $check_is_schedule_has_null["check_null"];
        
                            foreach ($check_is_schedule_has_null["day_schedule"] as $day_name => $day_data) {
                                foreach ($day_data as $day_key => $day_value) {
                                    $temp_array[$day_key] = $day_value; 
                                }
                            }
                            
                            if(!$checknull) {
                                array_push($scheduleArray, $temp_array);
                            }
                        }
                    }
                }
            }
                
            $class_rowspan = 0;
        }

        foreach ($scheduleArray as $key => $class) {
            if($class["class_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["class_name"] == $class["class_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["class_rowspan"] = $row_count;
            }

            if($class["batch_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["batch_name"] == $class["batch_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["batch_rowspan"] = $row_count;
            }
        }

        return response()->json($scheduleArray);
    }

    public function all_routines() {
        
        $classArray = [];
        $all_class = InstituteClass::where('branch_id', $this->getBranchID())->get();
        foreach ($all_class as $key => $class_item) {
            $temp_array = [];
            $temp_array = $class_item;
            $class_batch = InstituteClassBatch::where('institute_class_id', $class_item->id)->with(['subjects'])->get();
            
            $class_item['batch'] = $class_batch;
            

            array_push($classArray, $temp_array); 
        }
        
        $scheduleArray = [];

        foreach ($classArray as $key => $newclassItem) {
            
            $temp_array = [];
            $temp_array['class_name'] = $newclassItem->title;

            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                // dd($batchItem);
                $temp_array['batch_name'] = $batchItem->name . $batchItem->id;
                $temp_array['batch_name_only'] = $batchItem->name;
                
                foreach ($batchItem->subjects as $subjectKey => $subjectItem) {
                    
                    if($subjectKey == 0) {
                        $temp_array['class_rowspan'] = $batchItem->subjects->count();
                        $temp_array['batch_rowspan'] =  $batchItem->subjects->count();
                    }
                    if($subjectKey > 0 ){
                        $temp_array['class_rowspan'] = 0;
                        $temp_array['batch_rowspan'] = 0;
                    }
                    $temp_array['subject_name'] = $subjectItem->title;

                    $temp_array['saturday_time'] = "";
                    $temp_array['saturday_room'] = "";
                    $temp_array['sunday_time'] = "";
                    $temp_array['sunday_room'] = "";
                    $temp_array['monday_time'] = "";
                    $temp_array['monday_room'] = "";
                    $temp_array['tuesday_time'] = "";
                    $temp_array['tuesday_room'] = "";
                    $temp_array['wednesday_time'] = "";
                    $temp_array['wednesday_room'] = "";
                    $temp_array['thursday_time'] = "";
                    $temp_array['thursday_room'] = "";
                    $temp_array['friday_time'] = "";
                    $temp_array['friday_room'] = "";
                    $checknull = true;
                    
                    $all_routine_schedules = $this->get_seven_day_schedules($newclassItem->id, $batchItem->id, $subjectItem->id);
                    $check_is_schedule_has_null = $this->get_check_is_schedule_has_null($all_routine_schedules);
                    $checknull = $check_is_schedule_has_null["check_null"];

                    foreach ($check_is_schedule_has_null["day_schedule"] as $day_name => $day_data) {
                        foreach ($day_data as $day_key => $day_value) {
                            $temp_array[$day_key] = $day_value; 
                        }
                    }
                    
                    if(!$checknull) {
                        array_push($scheduleArray, $temp_array);
                    }
                }
                // dd('some');
            }
                
            $class_rowspan = 0;
        }

        foreach ($scheduleArray as $key => $class) {
            if($class["class_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["class_name"] == $class["class_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["class_rowspan"] = $row_count;
            }

            if($class["batch_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    
                    if($t_class["batch_name"] == $class["batch_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["batch_rowspan"] = $row_count;
            }
        }

        return response()->json($scheduleArray);
    }

    public function get_seven_day_schedules_teacher($class_id, $batch_id, $subject_id, $teacher_id)  {
        
        $saturday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'saturday')
        ->where('institute_class_id', $class_id)->first();

        $sunday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'sunday')
        ->where('institute_class_id', $class_id)->first();

        $monday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'monday')
        ->where('institute_class_id', $class_id)->first();

        $tuesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'tuesday')
        ->where('institute_class_id', $class_id)->first();

        $wednesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'wednesday')
        ->where('institute_class_id', $class_id)->first();

        $thursday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'thursday')
        ->where('institute_class_id', $class_id)->first();

        $friday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('institute_class_teacher_id', $teacher_id)
        ->where('day', 'friday')
        ->where('institute_class_id', $class_id)->first();

        $weekly_data_find = [
            "saturday_schedule" => $saturday_schedule_find, 
            "sunday_schedule" => $sunday_schedule_find,
            "monday_schedule" => $monday_schedule_find,
            "tuesday_schedule" => $tuesday_schedule_find,
            "wednesday_schedule" => $wednesday_schedule_find,
            'thursday_schedule' => $thursday_schedule_find,
            "friday_schedule" => $friday_schedule_find
        ];

        // dump($weekly_data_find, $class_id, $batch_id, $subject_id);

        
        return $weekly_data_find;
    }

    public function get_seven_day_schedules_student($class_id, $batch_id, $subject_id)  {
        
        $saturday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'saturday')
        ->where('institute_class_id', $class_id)->first();

        $sunday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'sunday')
        ->where('institute_class_id', $class_id)->first();

        $monday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'monday')
        ->where('institute_class_id', $class_id)->first();

        $tuesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'tuesday')
        ->where('institute_class_id', $class_id)->first();

        $wednesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'wednesday')
        ->where('institute_class_id', $class_id)->first();

        $thursday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'thursday')
        ->where('institute_class_id', $class_id)->first();

        $friday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'friday')
        ->where('institute_class_id', $class_id)->first();

        $weekly_data_find = [
            "saturday_schedule" => $saturday_schedule_find, 
            "sunday_schedule" => $sunday_schedule_find,
            "monday_schedule" => $monday_schedule_find,
            "tuesday_schedule" => $tuesday_schedule_find,
            "wednesday_schedule" => $wednesday_schedule_find,
            'thursday_schedule' => $thursday_schedule_find,
            "friday_schedule" => $friday_schedule_find
        ];

        // dump($weekly_data_find, $class_id, $batch_id, $subject_id);

        
        return $weekly_data_find;
    }

    public function get_seven_day_schedules($class_id, $batch_id, $subject_id) {
        
        $saturday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'saturday')
        ->where('institute_class_id', $class_id)->first();

        $sunday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'sunday')
        ->where('institute_class_id', $class_id)->first();

        $monday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'monday')
        ->where('institute_class_id', $class_id)->first();

        $tuesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'tuesday')
        ->where('institute_class_id', $class_id)->first();

        $wednesday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'wednesday')
        ->where('institute_class_id', $class_id)->first();

        $thursday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'thursday')
        ->where('institute_class_id', $class_id)->first();

        $friday_schedule_find = InstituteClassBatchTimeSchedule::where('institute_class_subject_id', $subject_id)
        ->where('institute_class_batch_id', $batch_id)
        ->where('day', 'friday')
        ->where('institute_class_id', $class_id)->first();

        $weekly_data_find = [
            "saturday_schedule" => $saturday_schedule_find, 
            "sunday_schedule" => $sunday_schedule_find,
            "monday_schedule" => $monday_schedule_find,
            "tuesday_schedule" => $tuesday_schedule_find,
            "wednesday_schedule" => $wednesday_schedule_find,
            'thursday_schedule' => $thursday_schedule_find,
            "friday_schedule" => $friday_schedule_find
        ];

        // dump($weekly_data_find, $class_id, $batch_id, $subject_id);

        
        return $weekly_data_find;
    }

    public function get_day_schedule($day_schedules, $day_name) {

        $temp_array = [];
        $temp_array["$day_name" . '_temp_arrayime'] = "";
        $temp_array["$day_name" . '_room'] = "";
        $temp_array["$day_name" . '_null'] = true;
        foreach ($day_schedules as $day_schedule) {
            if(isset($day_schedule->day) && $day_schedule->day == $day_name) {
                $temp_array["$day_name" . '_time'] = Carbon::parse($day_schedule->start_time)->format('g:i a') . " - " . Carbon::parse($day_schedule->end_time)->format('g:i a');
                $temp_array["$day_name" . '_room'] = $day_schedule->room;
                $temp_array["$day_name" . '_null'] = false;
            }
        }

        return $temp_array;
    }

    public function get_check_is_schedule_has_null($day_schedules)  {
        $check_null = true;
        $temp = [];
        foreach (["saturday","sunday","monday","tuesday","wednesday","thursday","friday"] as $key => $day) {
            $temp[$day] = $this->get_day_schedule($day_schedules, $day);
            if(!$temp[$day][$day."_null"]){
                $check_null = false;
            }
        }
        return [
            "day_schedule" => $temp,
            "check_null" => $check_null
        ];
    }

    

    public function show($id)
    {
        $data = InstituteClassBatchTimeSchedule::where('id',$id)
        ->where('branch_id', $this->getBranchID())
        ->with(['batch','class','subject', 'teacher' => function($q) {
            $q->with('user');
        }])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    function admin_show($id) : object {
        $data = InstituteClassBatchTimeSchedule::where('id',$id)
        ->with(['batch','class','subject', 'teacher' => function($q) {
            $q->with('user');
        }])->first();
        if(!$data){
            return response()->json([
                'err_message' => 'not found',
                'errors' => ['role'=>['data not found']],
            ], 422);
        }
        return response()->json($data,200);
    }

    public function all_branches() {
        $branches = InstituteBranch::where('status', 1)->get();

        return response()->json($branches);
    }

    public function branch_wise_routine() {
        
        $id=request()->branch_id;
        $classArray = [];
        $all_class = InstituteClass::where('branch_id', $id)->get();
        foreach ($all_class as $key => $class_item) {
            $temp_array = [];
            $temp_array = $class_item;
            $class_batch = InstituteClassBatch::where('institute_class_id', $class_item->id)->with(['subjects'])->get();
            
            $class_item['batch'] = $class_batch;
            

            array_push($classArray, $temp_array); 
        }
        
        $scheduleArray = [];

        foreach ($classArray as $key => $newclassItem) {
            
            $temp_array = [];
            $temp_array['class_name'] = $newclassItem->title;

            foreach ($newclassItem->batch as $batchkey => $batchItem) {
                // dd($batchItem);
                $temp_array['batch_name'] = $batchItem->name . $batchItem->id;
                $temp_array['batch_name_only'] = $batchItem->name;
                
                foreach ($batchItem->subjects as $subjectKey => $subjectItem) {
                    
                    if($subjectKey == 0) {
                        $temp_array['class_rowspan'] = $batchItem->subjects->count();
                        $temp_array['batch_rowspan'] =  $batchItem->subjects->count();
                    }
                    if($subjectKey > 0 ){
                        $temp_array['class_rowspan'] = 0;
                        $temp_array['batch_rowspan'] = 0;
                    }
                    $temp_array['subject_name'] = $subjectItem->title;

                    $temp_array['saturday_time'] = "";
                    $temp_array['saturday_room'] = "";
                    $temp_array['sunday_time'] = "";
                    $temp_array['sunday_room'] = "";
                    $temp_array['monday_time'] = "";
                    $temp_array['monday_room'] = "";
                    $temp_array['tuesday_time'] = "";
                    $temp_array['tuesday_room'] = "";
                    $temp_array['wednesday_time'] = "";
                    $temp_array['wednesday_room'] = "";
                    $temp_array['thursday_time'] = "";
                    $temp_array['thursday_room'] = "";
                    $temp_array['friday_time'] = "";
                    $temp_array['friday_room'] = "";
                    $checknull = true;
                    
                    $all_routine_schedules = $this->get_seven_day_schedules($newclassItem->id, $batchItem->id, $subjectItem->id);
                    $check_is_schedule_has_null = $this->get_check_is_schedule_has_null($all_routine_schedules);
                    $checknull = $check_is_schedule_has_null["check_null"];

                    foreach ($check_is_schedule_has_null["day_schedule"] as $day_name => $day_data) {
                        foreach ($day_data as $day_key => $day_value) {
                            $temp_array[$day_key] = $day_value; 
                        }
                    }
                    
                    if(!$checknull) {
                        array_push($scheduleArray, $temp_array);
                    }
                }
                // dd('some');
            }
                
            $class_rowspan = 0;
        }

        foreach ($scheduleArray as $key => $class) {
            if($class["class_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    if($t_class["class_name"] == $class["class_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["class_rowspan"] = $row_count;
            }

            if($class["batch_rowspan"]){
                $row_count = 0;
                foreach ($scheduleArray as $t_class) {
                    
                    if($t_class["batch_name"] == $class["batch_name"]){
                        $row_count++;
                    }
                }
                $scheduleArray[$key]["batch_rowspan"] = $row_count;
            }
        }

        return response()->json($scheduleArray);
    }

    public function store()
    {
        // dd(json_decode(request()->subjects), request()->institute_class_id, request()->institute_batch_id);


        $validator = Validator::make(request()->all(), [
            'institute_class_id' => ['required'],
            'institute_class_batch_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $subjects = json_decode(request()->subjects);

        foreach ($subjects as $key => $subject) {
            foreach ($subject->days as $day) {
                if (!is_null($day)) {
                    // Check if the current day's start_time, end_time, and room are the same as the previous day
                    $check_data = InstituteClassBatchTimeSchedule::where('start_time', $subject->start_time)
                                    ->where('end_time', $subject->end_time)
                                    ->where('room', $subject->room_no)
                                    ->where('day', $day)
                                    ->where('institute_class_teacher_id', request()->institute_class_teacher_id)
                                    ->first();
                    // dd($check_data, $subject->start_time, $subject->end_time, $subject->room_no ,$day, request()->institute_class_teacher_id);
                    if ($check_data !== null) {
                        return response()->json(["message" => "this teacher has other class at this time.", "type" => 'warning'], 200);
                    } else {
                        $data = new InstituteClassBatchTimeSchedule();
                        $data->day = $day;  // Assuming $day is the day name like "Saturday" or "Sunday"
                        $data->start_time = $subject->start_time;
                        $data->end_time = $subject->end_time;
                        $data->room = $subject->room_no;
                        $data->branch_id = $this->getBranchID();
                        $data->institute_class_id = request()->institute_class_id;
                        $data->institute_class_batch_id = request()->institute_class_batch_id;
                        $data->institute_class_subject_id = $subject->id;
                        $data->institute_class_teacher_id = request()->institute_class_teacher_id;
                        $data->save();
                    }
                }
            }
        }

        

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'day' => ['required'],
            'time' => ['required'],
            'institute_class_id' => ['required'],
            'institute_class_subject_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new InstituteClassBatchTimeSchedule();
        $data->day = request()->day;
        $data->time = request()->time;
        $data->room = request()->room;
        $data->branch_id = $this->getBranchID();
        $data->institute_class_id = request()->institute_class_id;
        $data->institute_class_subject_id = request()->institute_class_subject_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = InstituteClassBatchTimeSchedule::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'day' => ['required'],
            'time' => ['required'],
            'institute_class_id' => ['required'],
            'institute_class_subject_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->day = request()->day;
        $data->start_time = request()->start_time;
        $data->end_time = request()->end_time;
        $data->room = request()->room;
        $data->branch_id = $this->getBranchID();
        $data->institute_class_id = request()->institute_class_id;
        $data->institute_class_batch_id = request()->institute_class_batch_id;
        $data->institute_class_subject_id = request()->institute_class_subject_id;
        $data->institute_class_teacher_id = request()->institute_class_teacher_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = InstituteClassBatchTimeSchedule::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['InstituteClass not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'day' => ['required'],
            'time' => ['required'],
            'institute_class_id' => ['required'],
            'institute_class_subject_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->day = request()->day;
        $data->time = request()->time;
        $data->room = request()->room;
        $data->branch_id = $this->getBranchID();
        $data->institute_class_id = request()->institute_class_id;
        $data->institute_class_subject_id = request()->institute_class_subject_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:institute_class_batch_time_schedules,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = InstituteClassBatchTimeSchedule::where('id', request()->id)->delete();

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
            $check = InstituteClassBatchTimeSchedule::where('id',$item->id)->first();
            if(!$check){
                try {
                    InstituteClassBatchTimeSchedule::create((array) $item);
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
