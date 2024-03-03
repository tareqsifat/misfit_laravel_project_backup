<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseWhatYouWillGets;
use Illuminate\Database\Seeder;

class CourseWhatYouWillGetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseWhatYouWillGets::truncate();
        CourseWhatYouWillGets::create([
            'course_id' => 1,
            'title' => 'ইন্টার্নশিপ সুযোগ',
        ]);
        CourseWhatYouWillGets::create([
            'course_id' => 1,
            'title' => '৫০ টি লাইভ ক্লাস',
        ]);
        CourseWhatYouWillGets::create([
            'course_id' => 1,
            'title' => 'আজীবন লাইভ সাপোর্ট',
        ]);
    }
}
