<?php

namespace Database\Seeders;

use App\Models\CourseType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseType::truncate();
        CourseType::create([
            'title' => 'অনলাইন কোর্স'
        ]);

        CourseType::create([
            'title' => 'অফলাইন কোর্স'
        ]);

        CourseType::create([
            'title' => 'ডে-কেয়ার কোর্স'
        ]);

        DB::table('course_course_types')->truncate();
        DB::table('course_course_types')->insert([
            'course_type_id' => 1,
            'course_id' => 1,
        ]);

        DB::table('course_course_types')->insert([
            'course_type_id' => 1,
            'course_id' => 1,
        ]);

        DB::table('course_course_types')->insert([
            'course_type_id' => 1,
            'course_id' => 2,
        ]);

        DB::table('course_course_types')->insert([
            'course_type_id' => 2,
            'course_id' => 3,
        ]);

        DB::table('course_course_types')->insert([
            'course_type_id' => 3,
            'course_id' => 1,
        ]);

        DB::table('course_course_types')->insert([
            'course_type_id' => 3,
            'course_id' => 2,
        ]);
    }
}
