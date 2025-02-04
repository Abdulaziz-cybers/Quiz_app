<?php

namespace App\Http\Controllers\API;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Traits\Validator;
use JetBrains\PhpStorm\NoReturn;
use Src\Auth;

class ResultController
{
    use Validator;
    #[NoReturn] public function store(): void
    {
        $resultItems = $this->validate([
            'quiz_id' => 'required',
        ]);
        $quiz= (new Quiz())->find($resultItems['quiz_id']);
        if ($quiz) {
            $result = new Result();
            $userResult = $result->getUserResult(Auth::user()->id, $quiz->id);
            if ($userResult){
                $answerCount = (new Answer())->getCorrectAnswers(Auth::user()->id, $quiz->id);
                $questionCount = (new Question())->getCountOfQuestions($quiz->id);
                $diff = abs(strtotime($userResult->finished_at) - strtotime($userResult->started_at));
                apiResponse([
                    'errors' => [
                        'message' => 'You already have result for this quiz'
                    ],
                    'result' => [
                        'id' => $userResult->id,
                        'user_id' => $userResult->user_id,
                        'quiz' => $quiz,
                        'time_taken' => floor($diff / 60) . ':' . ($diff % 60),
                        'correct_answers' => $answerCount,
                        'question_count' => $questionCount
                    ]
                ],400);
            }
            $res = $result->create(
                Auth::user()->id,
                $quiz->id,
                $quiz->time_limit
            );
            apiResponse([
                'message' => 'Result created successfully.',
                'result' => $res
            ]);
        }
        apiResponse([
            'errors' => [
                'message' => 'Quiz not found'
            ]
        ], 400);
    }
    #[NoReturn] public function update(): void
    {
        $updatedItem = $this->validate([
            'result_id' => 'required',
            'time_taken' => 'required',
            'quiz_id' => 'required',
        ]);
        $result = (new Result())->update($updatedItem['result_id'], $updatedItem['time_taken']);
        if ($result) {
            $quiz= (new Quiz())->find($updatedItem['quiz_id']);
            $answerCount = (new Answer())->getCorrectAnswers(Auth::user()->id, $quiz->id);
            $questionCount = (new Question())->getCountOfQuestions($quiz->id);
            $diff = abs(strtotime($result->finished_at) - strtotime($result->started_at));
            apiResponse([
                'message' => 'Result updated successfully.',
                'result' => $result,
                'time_taken' => floor($diff / 60) . ':' . ($diff % 60),
                'correct_answers' => $answerCount,
                'question_count' => $questionCount,
                'quiz' => $quiz
            ]);
        }
        apiResponse([
            'errors' => [
                'message' => 'Result not found'
            ]
        ], 400);
    }
}