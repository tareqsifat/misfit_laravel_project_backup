<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModuleTaskCompleteByUsers;
use Illuminate\Database\Seeder;

class CourseModuleTaskCompleteByUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModuleTaskCompleteByUsers::truncate();
        CourseModuleTaskCompleteByUsers::create([
            'course_id' => 1,
            'module_id' => 1,
            'class_id' => 1,
            'user_id' => 6,
            'quiz_id' => 1,
        ]);
        CourseModuleTaskCompleteByUsers::create([
            'course_id' => 1,
            'module_id' => 1,
            'class_id' => 1,
            'user_id' => 6,
            'exam_id' => 1,
        ]);

    }
}
