<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizUser;
use Illuminate\Database\Seeder;

class QuizUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizUser::truncate();
        QuizUser::create([ 
            'user_id' => '2',
            'quiz_id' => '1',
            'mark' => '2',
        ]);

        QuizUser::create([ 
            'user_id' => '2',
            'quiz_id' => '2',
            'mark' => '2',
        ]);
        QuizUser::create([ 
            'user_id' => '6',
            'quiz_id' => '1',
            'mark' => '2',
        ]);

        QuizUser::create([ 
            'user_id' => '3',
            'quiz_id' => '2',
            'mark' => '2',
        ]);

        QuizUser::create([ 
            'user_id' => '3',
            'quiz_id' => '3',
            'mark' => '2',
        ]);


        QuizUser::create([ 
            'user_id' => '4',
            'quiz_id' => '3',
            'mark' => '1',
        ]);
    }
}
