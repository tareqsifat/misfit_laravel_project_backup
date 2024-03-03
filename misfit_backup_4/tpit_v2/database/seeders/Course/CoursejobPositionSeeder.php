<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseJobPositions;
use Illuminate\Database\Seeder;

class CoursejobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseJobPositions::truncate();
        CourseJobPositions::create([
            'course_id' => 1,
            'title' => 'Web Developer',
        ]);

        CourseJobPositions::create([
            'course_id' => 2,
            'title' => 'Full Stuck Developer',
        ]);

        CourseJobPositions::create([
            'course_id' => 3,
            'title' => 'Backend Developer',
        ]);

    }
}
