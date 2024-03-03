<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClassBatchExam;
use Illuminate\Database\Seeder;

class BatchExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteClassBatchExam::truncate();

        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 1;
        $class_batch->exam_title = "Daily Model Test";
        $class_batch->institute_class_batch_id = 1;
        $class_batch->save();

        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 2;
        $class_batch->exam_title = "Daily Model Test";
        $class_batch->institute_class_batch_id = 2;
        $class_batch->save();


        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 1;
        $class_batch->exam_title = "Monthly Model Test";
        $class_batch->institute_class_batch_id = 3;
        $class_batch->save();

        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 2;
        $class_batch->exam_title = "Monthly Model Test";
        $class_batch->institute_class_batch_id = 4;
        $class_batch->save();


        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 1;
        $class_batch->exam_title = "Final Model Test";
        $class_batch->institute_class_batch_id = 4;
        $class_batch->save();

        $class_batch = new InstituteClassBatchExam();
        $class_batch->subject_id = 2;
        $class_batch->exam_title = "Final Model Test";
        $class_batch->institute_class_batch_id = 5;
        $class_batch->save();
    }
}
