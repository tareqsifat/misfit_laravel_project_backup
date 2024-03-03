<?php

namespace Database\Seeders;

use App\Models\SeekerProfile\Experience;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        if(Experience::count() == 0){
            Experience::create([
                'user_id' => 1,
                'is_current_job' => 0,
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2018')->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('d-m-Y', '31-01-2019')->format('Y-m-d'),
                'job_title' => 'Software engineer',
                'company_id' => 1,
                'job_location_city' => 1,
                'job_location_state' => 1,
                'job_location_country' => 1,
                'description' => 'this is a demo description',
            ]);
            Experience::create([
                'user_id' => 1,
                'is_current_job' => 0,
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2018')->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('d-m-Y', '31-01-2019')->format('Y-m-d'),
                'job_title' => 'Software engineer',
                'company_id' => 2,
                'job_location_city' => 1,
                'job_location_state' => 1,
                'job_location_country' => 1,
                'description' => 'this is a demo description',
            ]);
            Experience::create([
                'user_id' => 1,
                'is_current_job' => 0,
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2018')->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('d-m-Y', '31-01-2019')->format('Y-m-d'),
                'job_title' => 'Software engineer',
                'company_id' => 3,
                'job_location_city' => 1,
                'job_location_state' => 1,
                'job_location_country' => 1,
                'description' => 'this is a demo description',
            ]);
            Experience::create([
                'user_id' => 1,
                'is_current_job' => 0,
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2018')->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('d-m-Y', '31-01-2019')->format('Y-m-d'),
                'job_title' => 'Software engineer',
                'company_id' => 4,
                'job_location_city' => 1,
                'job_location_state' => 1,
                'job_location_country' => 1,
                'description' => 'this is a demo description',
            ]);
            Experience::create([
                'user_id' => 1,
                'is_current_job' => 1,
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2018')->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('d-m-Y', '31-01-2019')->format('Y-m-d'),
                'job_title' => 'Software engineer',
                'company_id' => 5,
                'job_location_city' => 1,
                'job_location_state' => 1,
                'job_location_country' => 1,
                'description' => 'this is a demo description',
            ]);
//        }
    }
}
