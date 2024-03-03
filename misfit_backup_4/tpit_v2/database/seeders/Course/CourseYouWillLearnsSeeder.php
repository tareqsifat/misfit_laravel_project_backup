<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseWillLearns;
use App\Models\Course\CourseYouWillLearns;
use Illuminate\Database\Seeder;

class CourseYouWillLearnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseYouWillLearns::truncate();
        CourseYouWillLearns::create([
            'course_id' => 1,
            'title' => 'Stardard coding',
        ]);
        CourseYouWillLearns::create([
            'course_id' => 1,
            'title' => 'Production standared work',
        ]);
        CourseYouWillLearns::create([
            'course_id' => 1,
            'title' => 'time manegment',
        ]);
        CourseYouWillLearns::create([
            'course_id' => 1,
            'title' => 'promp engineering',
        ]);

    }
}
