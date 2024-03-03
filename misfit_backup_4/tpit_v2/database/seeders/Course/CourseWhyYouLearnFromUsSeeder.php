<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseWhyYouLearnFromUs;
use Illuminate\Database\Seeder;

class CourseWhyYouLearnFromUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseWhyYouLearnFromUs::truncate();
        CourseWhyYouLearnFromUs::create([
            'course_id' => 1,
            'title' => 'full time support',
        ]);
        CourseWhyYouLearnFromUs::create([
            'course_id' => 1,
            'title' => 'teacher support',
        ]);
        CourseWhyYouLearnFromUs::create([
            'course_id' => 1,
            'title' => 'dialy monitoring',
        ]);

    }
}
