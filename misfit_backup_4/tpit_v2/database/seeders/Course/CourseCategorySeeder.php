<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseCategory::truncate();
        
        CourseCategory::create([

            'title' => 'ওয়েব ডিজাইন & ডেভেলপম্যান্ট ',
            'image' => 'frontend/assets/images/course_icon/web.svg'
        ]);
        CourseCategory::create([
            'title' => 'গ্রাফিক্স ডিজাইন',
            'image' => 'frontend/assets/images/course_icon/graphics.svg'
        ]);
        CourseCategory::create([
            'title' => 'ডিজিটাল মার্কেটিং',
            'image' => 'frontend/assets/images/course_icon/digital_marketing.svg'
        ]);

        DB::table('course_course_category')->truncate();
        DB::table('course_course_category')->insert([
            'course_category_id' => 1,
            'course_id' => 1,
        ]);
    }
}
