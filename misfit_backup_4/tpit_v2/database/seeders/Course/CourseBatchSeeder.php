<?php

namespace Database\Seeders\Course;

use App\Models\Course\CourseBatches;
use App\Models\Course\CourseBatchStudent;
use Illuminate\Database\Seeder;

class CourseBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseBatches::truncate();
        $batch = CourseBatches::create([
            'course_id' => 1,
            'batch_name' => 'WD-1',
            'admission_start_date' => '2023-09-25',
            'admission_end_date' => '2023-10-25',
            'batch_student_limit' => 30,
            'booked_percent' => 65,
            'seat_booked' => rand(5,10),
            'course_price' => 10000,
            'course_discount' => 30,
            'after_discount_price' => 7000,
            'first_class_date' => '2023-10-26',
            'class_days' => 'রবিবার,মঙ্গলবার,বৃহস্পতিবার' ,
            'class_start_time' => '21:00',
            'class_end_time' => '22:30',
        ]);

        CourseBatchStudent::create([
            'course_id' => 1,
            'batch_id' => $batch->id,
            'student_id' => 6,
        ]);

        $batch = CourseBatches::create([
            'course_id' => 2,
            'batch_name' => 'GD-1',
            'admission_start_date' => '2023-09-25',
            'admission_end_date' => '2023-10-25',
            'batch_student_limit' => 30,
            'booked_percent' => 56,
            'seat_booked' => rand(5,10),
            'course_price' => 10000,
            'course_discount' => 30,
            'after_discount_price' => 7000,
            'first_class_date' => '2023-10-26',
            'class_days' => 'রবিবার,মঙ্গলবার,বৃহস্পতিবার' ,
            'class_start_time' => '10:00',
            'class_end_time' => '12:00',
        ]);

        CourseBatchStudent::create([
            'course_id' => 1,
            'batch_id' => $batch->id,
            'student_id' => 7,
        ]);

        $batch = CourseBatches::create([
            'course_id' => 3,
            'batch_name' => 'dm-202305',
            'admission_start_date' => '2023-09-25',
            'admission_end_date' => '2023-10-25',
            'batch_student_limit' => 30,
            'booked_percent' => 76,
            'seat_booked' => rand(5,10),
            'course_price' => 10000,
            'course_discount' => 30,
            'after_discount_price' => 7000,
            'first_class_date' => '2023-10-26',
            'class_days' => 'রবিবার,মঙ্গলবার,বৃহস্পতিবার' ,
            'class_start_time' => '21:00',
            'class_end_time' => '22:00',
        ]);

        CourseBatchStudent::create([
            'course_id' => 1,
            'batch_id' => $batch->id,
            'student_id' => 7,
        ]);

        $batch = CourseBatches::create([
            'course_id' => 3,
            'batch_name' => 'DM-1',
            'admission_start_date' => '2023-09-25',
            'admission_end_date' => '2023-10-25',
            'batch_student_limit' => 30,
            'booked_percent' => 76,
            'seat_booked' => rand(5,10),
            'course_price' => 10000,
            'course_discount' => 30,
            'after_discount_price' => 7000,
            'first_class_date' => '2023-10-26',
            'class_days' => 'রবিবার,মঙ্গলবার,বৃহস্পতিবার' ,
            'class_start_time' => '20:30',
            'class_end_time' => '22:00',
        ]);

        CourseBatchStudent::create([
            'course_id' => 1,
            'batch_id' => $batch->id,
            'student_id' => 7,
        ]);
    }
}
