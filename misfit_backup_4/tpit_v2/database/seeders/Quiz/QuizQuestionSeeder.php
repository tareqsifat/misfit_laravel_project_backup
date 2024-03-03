<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizQuestion::truncate();
        QuizQuestion::create([
            'quiz_id' => '1',
            'title' => 'Who is the father of c programing?',
            'mark' => '1',
            'is_multiple' => '0'

        ]);
        QuizQuestion::create([

            'quiz_id' => '1',
            'title' => 'Which of the following are unary operators in C?',
            'mark' => '1',
            'is_multiple' => '1'

        ]);

        QuizQuestion::create([

            'quiz_id' => '1',
            'title' => 'The keyword used to transfer control from a function back to the calling function is.',
            'mark' => '1',
            'is_multiple' => '0'

        ]);






        QuizQuestion::create([

            'quiz_id' => '2',
            'title' => 'Who is the father of php?',
            'mark' => '1',
            'is_multiple' => '0'


        ]);
        QuizQuestion::create([

            'quiz_id' => '2',
            'title' => 'What are the popular frameworks in PHP ?',
            'mark' => '1',
            'is_multiple' => '1'

        ]);
        QuizQuestion::create([

            'quiz_id' => '2',
            'title' => 'What are the different types of loop in PHP ',
            'mark' => '1',
            'is_multiple' => '0'

        ]);




        QuizQuestion::create([

            'quiz_id' => '3',
            'title' => 'Who is the father of java programing?',
            'mark' => '1',
            'is_multiple' => '0'

        ]);

        QuizQuestion::create([

            'quiz_id' => '3',
            'title' => 'what is DML Commands are',
            'mark' => '1',
            'is_multiple' => '1'

        ]);
    }
}
