<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseJobWorks;
use Illuminate\Database\Seeder;


class CourseJobWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseJobWorks::truncate();
        CourseJobWorks::create([
            'course_id' => 1,
            'title' => 'ওয়েবসাইট ডিজাইন',
        ]);

        CourseJobWorks::create([
            'course_id' => 2,
            'title' => 'ওয়েবসাইট ব্যাকএন্ড ডিজাইন',
        ]);

        CourseJobWorks::create([
            'course_id' => 3,
            'title' => 'ই-কমার্স ওয়েবসাইট ডিজাইন',
        ]);

        CourseJobWorks::create([
            'course_id' => 4,
            'title' => 'ফুলস্টাক ওয়েবসাইট ডিজাইন',
        ]);


    }
}
