<?php

namespace Database\Seeders\Institute;

use App\Models\Institute\InstituteClassSubject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituteClassSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstituteClassSubject::truncate();
        DB::table('institute_class_batch_institute_class_subject')->truncate();

        $institute_class_subject1 = new InstituteClassSubject();
        $institute_class_subject1->title = "English";
        $institute_class_subject1->branch_id = 2;
        $institute_class_subject1->subject_id = 1;
        $institute_class_subject1->save();
        $institute_class_subject1->batch()->attach([1,2,3,4,5,6,7,8,9,10]);

        $institute_class_subject2 = new InstituteClassSubject();
        $institute_class_subject2->title = "Math";
        $institute_class_subject2->branch_id = 2;
        $institute_class_subject2->subject_id = 2;
        $institute_class_subject2->save();
        $institute_class_subject1->batch()->attach([1,2,3,4,5,6,7,8,9,10]);


        $institute_class_subject3 = new InstituteClassSubject();
        $institute_class_subject3->title = "Bangla";
        $institute_class_subject3->branch_id = 2;
        $institute_class_subject3->subject_id = 3;
        $institute_class_subject3->save();
        $institute_class_subject3->batch()->attach([1,2,3,4,5,6]);

        $institute_class_subject4 = new InstituteClassSubject();
        $institute_class_subject4->title = "Science";
        $institute_class_subject4->branch_id = 2;
        $institute_class_subject4->subject_id = 4;
        $institute_class_subject4->save();
        $institute_class_subject4->batch()->attach([4,5,6,7,8,9,10]);

        $institute_class_subject5 = new InstituteClassSubject();
        $institute_class_subject5->title = "ICT";
        $institute_class_subject5->branch_id = 2;
        $institute_class_subject5->subject_id = 5;
        $institute_class_subject5->save();
        $institute_class_subject5->batch()->attach([4,5,6,7,8,9,10]);

    }
}
