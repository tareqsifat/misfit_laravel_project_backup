<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModule;
use Illuminate\Database\Seeder;

class CourseModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CourseModule::truncate();
        CourseModule::create([
            'course_id' => 1,
            'module_no' => 1,
            'title' => 'Frontend Recap',
        ]);   

        CourseModule::create([
            'course_id' => 1,
            'module_no' => 2,
            'title' => 'Object Oriented PHP',
        ]);   

        CourseModule::create([
            'course_id' => 1,
            'module_no' => 3,
            'title' => 'Understanding Server side Technology',
        ]);   
      
    }
}
