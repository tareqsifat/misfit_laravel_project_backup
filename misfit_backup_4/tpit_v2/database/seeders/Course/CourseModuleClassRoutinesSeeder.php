<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModulClassRoutines;
use App\Models\Course\CourseModuleClassRoutines;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseModuleClassRoutinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModuleClassRoutines::truncate();
        CourseModuleClassRoutines::create([
            'course_id' => 1,
            'module_id' => 1,
            'class_id'  => 1,
            'date' => '2023-01-11',
            'time' => '21:00',
            'topic' => 'php',

        ]);

        CourseModuleClassRoutines::create([
            'course_id' => 1,
            'module_id' => 2,
            'class_id'  => 4,
            'date' => '2023-01-12',
            'time' => '22:00',
            'topic' => 'javaScript',

        ]);

        CourseModuleClassRoutines::create([
            'course_id' => 1,
            'module_id' => 3,
            'class_id'  => 7,
            'date' => '2023-01-13',
            'time' => '21:00',
            'topic' => 'vue js',

        ]);


    }
}
