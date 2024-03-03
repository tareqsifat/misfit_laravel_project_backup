<?php

namespace Database\Seeders;

use App\Models\Job\JobPost;
use App\Models\Job\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        JobType::truncate();
        Schema::enableForeignKeyConstraints();
        
        $job_type = new JobType();
        $job_type->type_name = "Full time on site";
        $job_type->save();

        $job_type = new JobType();
        $job_type->type_name = "Part time on site";
        $job_type->save();

        $job_type = new JobType();
        $job_type->type_name = "Full time Remote";
        $job_type->save();

        $job_type = new JobType();
        $job_type->type_name = "Part time Remote";
        $job_type->save();

        $job_type = new JobType();
        $job_type->type_name = "Contractual";
        $job_type->save();

        Schema::disableForeignKeyConstraints();
        JobPost::truncate();
        Schema::enableForeignKeyConstraints();


        $job_post = new JobPost();
        $job_post->posted_by_id = 1;
        $job_post->job_title = "Software Engineer";
        $job_post->job_type_id = 1;
        $job_post->company_id = 1;
        $job_post->job_salary = "30000-50000";
        $job_post->job_location = "Dhaka, Bangladesh";
        $job_post->job_description = "We are looking for a software engineer to join our team. The ideal candidate will have a strong understanding of software engineering principles and experience in developing and maintaining software applications.";
        $job_post->deadline = now()->addDays(7);
        $job_post->vacancy = 10;
        $job_post->job_slug = "software-engineer";
        $job_post->save();

        $job_post = new JobPost();
        $job_post->posted_by_id = 1;
        $job_post->job_title = "Web Developer";
        $job_post->job_type_id = 3;
        $job_post->company_id = 2;
        $job_post->job_salary = "20000-30000";
        $job_post->job_location = "Dhaka, Bangladesh";
        $job_post->job_description = "We are looking for a web developer to join our team. The ideal candidate will have a strong understanding of web development principles and experience in developing and maintaining web applications.";
        $job_post->deadline = now()->addDays(7);
        $job_post->vacancy = 10;
        $job_post->job_slug = "web-developer";
        $job_post->save();

        $job_post = new JobPost();
        $job_post->posted_by_id = 1;
        $job_post->job_title = "System Engineer";
        $job_post->job_type_id = 3;
        $job_post->company_id = 3;
        $job_post->job_salary = "20000-30000";
        $job_post->job_location = "Dhaka, Bangladesh";
        $job_post->job_description = "We are looking for System Engineer to join our team. The ideal candidate will have a strong understanding of web development principles and experience in developing and maintaining web applications.";
        $job_post->deadline = now()->addDays(7);
        $job_post->vacancy = 10;
        $job_post->job_slug = "web-developer";
        $job_post->save();


        $job_post = new JobPost();
        $job_post->posted_by_id = 1;
        $job_post->job_title = "UI/UX Designer";
        $job_post->job_type_id = 1;
        $job_post->company_id = 4;
        $job_post->job_salary = "20000-30000";
        $job_post->job_location = "Dhaka, Bangladesh";
        $job_post->job_description = "We are looking for UI/UX Designer to join our team. The ideal candidate will have a strong understanding of web development principles and experience in developing and maintaining web applications.";
        $job_post->deadline = now()->addDays(7);
        $job_post->vacancy = 10;
        $job_post->job_slug = "web-developer";
        $job_post->save();
    }
}
