<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModuleClassQuizes;
use Illuminate\Database\Seeder;

class CourseModuleClassQuizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModuleClassQuizes::truncate();
        CourseModuleClassQuizes::create([
            'course_id' => 1,
            "course_module_id" => 1,
            'course_module_class_id' => 1,
            'quiz_id'  => 1,
        ]);
        
        CourseModuleClassQuizes::create([
            'course_id' => 1,
            "course_module_id" => 1,
            'course_module_class_id' => 2,
            'quiz_id'  => 2,
        ]);
    }
}
