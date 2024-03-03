<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModulAtAGlances;
use App\Models\Course\CourseModuleClassResourses;
use Illuminate\Database\Seeder;

class CourseModuleClassResoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModuleClassResourses::truncate();
        CourseModuleClassResourses::create([
            'course_id' => 1,
            'course_module_class_id' => 1,
            'course_module_id'  => 1,
            'resourse_content'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry  when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'resourse_link'  => 'https://www.youtube.com/watch?v=6oUi0C-aohw&list=PL9piC5qJFU80_9pl9Jq8D9HW1gX3KANSS',
        ]);

        CourseModuleClassResourses::create([
            'course_id' => 1,
            'course_module_class_id' => 4,
            'course_module_id'  => 2,
            'resourse_content'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'resourse_link'  => 'https://www.youtube.com/watch?v=wrSYnZAUNNo',
        ]);

        CourseModuleClassResourses::create([
            'course_id' => 1,
            'course_module_class_id' => 7,
            'course_module_id'  => 3,
            'resourse_content'  => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia',
            'resourse_link'  => 'https://www.youtube.com/watch?v=BV2GPKdpfGc',
        ]);

       
    }
}
