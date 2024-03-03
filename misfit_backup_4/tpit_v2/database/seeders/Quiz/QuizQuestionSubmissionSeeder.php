<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizQuestionSubmission;
use Illuminate\Database\Seeder;

class QuizQuestionSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizQuestionSubmission::truncate();
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '1',
            'option_id' => '1',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '1',
            'option_id' => '2',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '1',
            'option_id' => '3',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '1',
            'option_id' => '4',
            'is_correct' => '0'
        ]);

        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '2',
            'option_id' => '5',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '2',
            'option_id' => '6',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '2',
            'option_id' => '7',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '2',
            'option_id' => '8',
            'is_correct' => '1'
        ]);



        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '3',
            'option_id' => '9',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '3',
            'option_id' => '10',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '3',
            'option_id' => '11',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '2',
            'quiz_id' => '1',
            'question_id' => '3',
            'option_id' => '12',
            'is_correct' => '0'
        ]);




        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '4',
            'option_id' => '13',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '4',
            'option_id' => '14',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '4',
            'option_id' => '15',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '4',
            'option_id' => '16',
            'is_correct' => '0'
        ]);




        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '5',
            'option_id' => '17',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '5',
            'option_id' => '18',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '5',
            'option_id' => '19',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '5',
            'option_id' => '20',
            'is_correct' => '1'
        ]);





        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '6',
            'option_id' => '21',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '6',
            'option_id' => '22',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '6',
            'option_id' => '23',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '3',
            'quiz_id' => '2',
            'question_id' => '6',
            'option_id' => '24',
            'is_correct' => '0'
        ]);

        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '7',
            'option_id' => '25',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '7',
            'option_id' => '26',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '7',
            'option_id' => '27',
            'is_correct' => '0'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '7',
            'option_id' => '28',
            'is_correct' => '0'
        ]);








        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '8',
            'option_id' => '29',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '8',
            'option_id' => '30',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '8',
            'option_id' => '31',
            'is_correct' => '1'
        ]);
        QuizQuestionSubmission::create([
            'user_id' => '4',
            'quiz_id' => '3',
            'question_id' => '8',
            'option_id' => '32',
            'is_correct' => '1'
        ]);
    }
}
