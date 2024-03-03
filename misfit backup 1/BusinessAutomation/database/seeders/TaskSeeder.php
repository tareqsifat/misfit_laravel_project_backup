<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::truncate();
        for($i = 1; $i <= 20; $i++){
            Task::create([
                'name' => "Task  $i",
                'project_id' => $i/2,
                'description' => "This is a demo Description $i",
                'user_id' => "2",
                'status' => 1,
                'creator' => 1
            ]);
        }
    }
}
