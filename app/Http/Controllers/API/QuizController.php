<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Traits\Validator;
use Src\Auth;

class QuizController
{
    use Validator;
    public function create(): void
    {
        $quizData = $this->validate([
            'title' => 'string',
            'description' => 'string',
            'timeLimit' => 'integer',
            'questions' => 'array'
        ]);

        $quiz = new Quiz();
        $question = new Question();
        $option = new Option();

        $quizId = $quiz->create(Auth::user()->id, $quizData['title'], $quizData['description'], $quizData['timeLimit']);

        foreach ($quizData['questions'] as $questionData) {
            $questionId = $question->create($quizId, $questionData['quiz']);
            $isCorrect = $questionData['correct'];
            foreach ($questionData['options'] as $key => $optionData) {
                $option->create($questionId, $optionData, $isCorrect == $key );
            }
        }
    }
}