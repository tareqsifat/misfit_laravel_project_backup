<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClassBatchExamMark;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BatchExamMarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteClassBatchExamMark::truncate();

        $class_batch_exam_mark = new InstituteClassBatchExamMark();
        $class_batch_exam_mark->user_id = 4;
        $class_batch_exam_mark->batch_id = 1;
        $class_batch_exam_mark->batch_class_id = 1;
        $class_batch_exam_mark->institute_class_batch_exam_id = 1;
        $class_batch_exam_mark->date = Carbon::now()->subDay(1);
        $class_batch_exam_mark->mark = 80;
        $class_batch_exam_mark->save();

        $class_batch_exam_mark = new InstituteClassBatchExamMark();
        $class_batch_exam_mark->user_id = 5;
        $class_batch_exam_mark->batch_id = 1;
        $class_batch_exam_mark->batch_class_id = 1;
        $class_batch_exam_mark->institute_class_batch_exam_id = 1;
        $class_batch_exam_mark->date = Carbon::now()->subDay(1);
        $class_batch_exam_mark->mark = 80;
        $class_batch_exam_mark->save();

        $class_batch_exam_mark = new InstituteClassBatchExamMark();
        $class_batch_exam_mark->user_id = 6;
        $class_batch_exam_mark->batch_id = 1;
        $class_batch_exam_mark->batch_class_id = 1;
        $class_batch_exam_mark->institute_class_batch_exam_id = 1;
        $class_batch_exam_mark->date = Carbon::now()->subDay(1);
        $class_batch_exam_mark->mark = 80;
        $class_batch_exam_mark->save();

        $class_batch_exam_mark = new InstituteClassBatchExamMark();
        $class_batch_exam_mark->user_id = 7;
        $class_batch_exam_mark->batch_id = 1;
        $class_batch_exam_mark->batch_class_id = 1;
        $class_batch_exam_mark->institute_class_batch_exam_id = 1;
        $class_batch_exam_mark->date = Carbon::now()->subDay(1);
        $class_batch_exam_mark->mark = 80;
        $class_batch_exam_mark->save();

        $class_batch_exam_mark = new InstituteClassBatchExamMark();
        $class_batch_exam_mark->user_id = 8;
        $class_batch_exam_mark->batch_id = 1;
        $class_batch_exam_mark->batch_class_id = 1;
        $class_batch_exam_mark->institute_class_batch_exam_id = 1;
        $class_batch_exam_mark->date = Carbon::now()->subDay(1);
        $class_batch_exam_mark->mark = 80;
        $class_batch_exam_mark->save();
    }
}
