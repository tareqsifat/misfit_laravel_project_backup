<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizQuestionOption;
use Illuminate\Database\Seeder;

class QuizQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizQuestionOption::truncate();
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '1',
            'title' => 'Dennis Ritchie',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '1',
            'title' => 'Messi',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '1',
            'title' => 'Debala',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '1',
            'title' => 'Demaria',
            'is_correct' => '0'
        ]);






        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '2',
            'title' => '!',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '2',
            'title' => 'sizeof',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '2',
            'title' => '~',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '2',
            'title' => '&&',
            'is_correct' => '0'
        ]);



        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '3',
            'title' => 'switch',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '3',
            'title' => 'goto',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '3',
            'title' => 'go back',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '1',
            'question_id' => '3',
            'title' => 'return',
            'is_correct' => '1'
        ]);



        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '4',
            'title' => 'nishat',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '4',
            'title' => 'Rasmus Lerdorf',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '4',
            'title' => 'logu farguson',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '4',
            'title' => 'herry brook',
            'is_correct' => '0'
        ]);


        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '5',
            'title' => 'Laravel',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '5',
            'title' => 'CodeIgniter',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '5',
            'title' => 'Symfony',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '5',
            'title' => 'CakePHP',
            'is_correct' => '1'
        ]);


        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '6',
            'title' => 'for loop',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '6',
            'title' => 'while loop',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '6',
            'title' => 'foreach loop',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '2',
            'question_id' => '6',
            'title' => 'do-while loop',
            'is_correct' => '0'
        ]);




        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '7',
            'title' => 'James Gosling',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '7',
            'title' => 'Gosling',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '7',
            'title' => 'Underson',
            'is_correct' => '0'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '7',
            'title' => 'jon Haris',
            'is_correct' => '0'
        ]);



        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '8',
            'title' => 'select',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '8',
            'title' => 'edit',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '8',
            'title' => 'update',
            'is_correct' => '1'
        ]);
        QuizQuestionOption::create([
            'quiz_id' => '3',
            'question_id' => '8',
            'title' => 'delete',
            'is_correct' => '1'
        ]);
    }
}
