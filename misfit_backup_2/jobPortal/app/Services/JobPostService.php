<?php

namespace App\Services;

class JobPostService
{
    public function save($jobPost, array $data)
    {
        $jobPost->job_type_id = $data['job_type_id'];
        $jobPost->deadline = $data['deadline'];
        $jobPost->job_title = $data['job_title'];
        $jobPost->vacancy = $data['vacancy'];
        $jobPost->job_salary = $data['job_salary'];
        $jobPost->job_location = $data['job_location'];
        $jobPost->job_description = $data['job_description'];
        $jobPost->save();
    }
}