<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModuleClassExams;
use Illuminate\Database\Seeder;

class CourseModuleClassExamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModuleClassExams::truncate();
        CourseModuleClassExams::create([
            'course_id' => 1,
            'course_module_class_id' => 1,
            'exam_id'  => 1,
        ]);
        CourseModuleClassExams::create([
            'course_id' => 1,
            'course_module_class_id' => 2,
            'exam_id'  => 2,
        ]);
    }
}
