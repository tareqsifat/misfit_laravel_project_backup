<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseForWhoms;
use Illuminate\Database\Seeder;

class CourseForWhomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseForWhoms::truncate();
        CourseForWhoms::create([
            'course_id' => 1,
            'title' => '৩ মাসের স্টাডি প্ল্যান',
        ]);

        CourseForWhoms::create([
            'course_id' => 2,
            'title' => '৫০ টি লাইভ ক্লাস',
        ]);

        CourseForWhoms::create([
            'course_id' => 3,
            'title' => 'ক্লাস রেকর্ডিং',
        ]);

        CourseForWhoms::create([
            'course_id' => 4,
            'title' => '১০ টি প্র্যাকটিকাল প্রজেক্ট',
        ]);
    }
}
