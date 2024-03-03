<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseModulAtAGlances;
use App\Models\Course\CourseModuleAtAGlances;
use Illuminate\Database\Seeder;

class CourseModulesAtAGlancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class="Database\Seeders\Course\CourseModulesAtAGlancesSeeder"
     * @return void
     */
    public function run()
    {
        CourseModuleAtAGlances::truncate();
        CourseModuleAtAGlances::create([
            'course_id' => 1,
            'title' => 'ইন্টার্নশিপ সুযোগ',
        ]);

        CourseModuleAtAGlances::create([
            'course_id' => 1,
            'title' => 'জব/ফ্রিলান্সিং গাইডলাইন',
        ]);

        CourseModuleAtAGlances::create([
            'course_id' => 1,
            'title' => '১৫ টি কুইজ',
        ]);

        CourseModuleAtAGlances::create([
            'course_id' => 1,
            'title' => 'কোর্স শেসে সার্টিফিকেট প্রদান',
        ]);

    }
}
