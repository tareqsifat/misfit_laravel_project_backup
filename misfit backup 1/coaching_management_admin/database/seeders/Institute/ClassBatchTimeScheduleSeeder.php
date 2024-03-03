<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClassBatchTimeSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClassBatchTimeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        InstituteClassBatchTimeSchedule::truncate();
        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Sunday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '4:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '5:30:00');
        $class_batch->institute_class_id = 1;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 1;
        $class_batch->institute_class_subject_id = 1;
        $class_batch->room = 101;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '5:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->institute_class_id = 1;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 2;
        $class_batch->institute_class_subject_id = 2;
        $class_batch->room = 102;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '7:30:00');
        $class_batch->institute_class_id = 1;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 2;
        $class_batch->institute_class_subject_id = 3;
        $class_batch->room = 103;
        $class_batch->save();


        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Sunday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '7:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '8:30:00');
        $class_batch->institute_class_id = 2;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 3;
        $class_batch->institute_class_subject_id = 1;
        $class_batch->room = 104;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '7:30:00');
        $class_batch->institute_class_id = 2;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 4;
        $class_batch->institute_class_subject_id = 2;
        $class_batch->room = 105;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '5:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->institute_class_id = 2;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 3;
        $class_batch->institute_class_subject_id = 3;
        $class_batch->room = 106;
        $class_batch->save();


        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Sunday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '4:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '5:30:00');
        $class_batch->institute_class_id = 3;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 4;
        $class_batch->institute_class_subject_id = 1;
        $class_batch->room = 107;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '5:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->institute_class_id = 3;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 5;
        $class_batch->institute_class_subject_id = 2;
        $class_batch->room = 108;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '6:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '7:30:00');
        $class_batch->institute_class_id = 3;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 5;
        $class_batch->institute_class_subject_id = 3;
        $class_batch->room = 109;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Sunday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '7:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '8:30:00');
        $class_batch->institute_class_id = 5;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 6;
        $class_batch->institute_class_subject_id = 1;
        $class_batch->room = 110;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '8:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '9:30:00');
        $class_batch->institute_class_id = 5;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 6;
        $class_batch->institute_class_subject_id = 2;
        $class_batch->room = 111;
        $class_batch->save();

        $class_batch = new InstituteClassBatchTimeSchedule();
        $class_batch->day = "Monday";
        $class_batch->start_time = Carbon::createFromFormat('H:i:s', '8:30:00');
        $class_batch->end_time = Carbon::createFromFormat('H:i:s', '9:30:00');
        $class_batch->institute_class_id = 5;
        $class_batch->branch_id = 2;
        $class_batch->institute_class_batch_id = 7;
        $class_batch->institute_class_subject_id = 3;
        $class_batch->room = 112;
        $class_batch->save();
    }
}
