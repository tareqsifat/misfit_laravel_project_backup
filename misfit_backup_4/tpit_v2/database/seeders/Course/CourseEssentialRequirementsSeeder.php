<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseEssentialRequirements;
use Illuminate\Database\Seeder;

class CourseEssentialRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseEssentialRequirements::truncate();
        CourseEssentialRequirements::create([
            'course_id' => 1,
            'title' => 'ইন্টারনেট সংযোগ যুক্ত কম্পিউটার',
        ]);

        CourseEssentialRequirements::create([
            'course_id' => 2,
            'title' => 'অক্লান্ত পরিশ্রমী',
        ]);

        CourseEssentialRequirements::create([
            'course_id' => 3,
            'title' => 'মানসিকতা',
        ]);
    }
}

