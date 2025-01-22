<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Traits\Validator;
use JetBrains\PhpStorm\NoReturn;
use Src\Auth;

class QuizController
{
    use Validator;
    #[NoReturn] public function get(int $quizId): void
    {
        $quiz = (new Quiz())->find($quizId);
        $questions = (new Question())->getByQuizId($quizId);
        $quiz->questions = $questions;
        apiResponse($quiz);
    }
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
    #[NoReturn] public function index(): void
    {
        $quizzes = (new Quiz())->getByUserId(Auth::user()->id);
        apiResponse(['quizzes' => $quizzes]);
    }
    public function update(int $quizId): void
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

        $quiz->update($quizId, $quizData['title'], $quizData['description'], $quizData['timeLimit']);
        $question->deleteByQuizId($quizId);

        foreach ($quizData['questions'] as $questionData) {
            $questionId = $question->create($quizId, $questionData['quiz']);
            $isCorrect = $questionData['correct'];
            foreach ($questionData['options'] as $key => $optionData) {
                $option->create($questionId, $optionData, $isCorrect == $key );
            }
        }
        apiResponse(['message' => 'Quiz updated']);
    }
    #[NoReturn] public function destroy(int $quizId): void
    {
        $quiz = new Quiz();
        $quiz->delete($quizId);
        apiResponse(
            ['message' => 'Quiz deleted']
        );
    }
}