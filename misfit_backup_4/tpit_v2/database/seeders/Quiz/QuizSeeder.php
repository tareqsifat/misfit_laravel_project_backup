<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::truncate();
        Quiz::create([
            'title' => 'c programing languge',
        ]);

        Quiz::create([
            'title' => 'php programing languge',
            
        ]);
        Quiz::create([
            'title' => 'java programing languge',
            
        ]);
    }
}
