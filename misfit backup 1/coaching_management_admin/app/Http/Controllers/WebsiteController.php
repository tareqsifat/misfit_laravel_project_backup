<?php

namespace App\Http\Controllers;

use App\Models\Accounts\BranchAccount;
use App\Models\Institute\InstituteClass;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchTimeSchedule;
use App\Models\Institute\InstituteStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;


class WebsiteController extends Controller
{
    

    public function get_schedules($id) {
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
        $daysOfWeek = [
            "saturday",
            "sunday",
            "monday",
            "tuesday",
            "wednesday",
            "thursday",
            "friday"
        ];

        $schedules = $scheduleArray;

        $html = view('livewire.components.schedule', compact('daysOfWeek', 'schedules'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Data loaded',
        ]);
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
}
