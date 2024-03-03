<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        for($i = 1; $i <= 10; $i++){
            $project = new Project();
            $project->name = "project $i";
            $project->code = "BA-PB-00$i";
            $project->save();
        }

    }
}
