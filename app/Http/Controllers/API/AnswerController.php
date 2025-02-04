<?php

namespace App\Http\Controllers\API;

use App\Models\Answer;
use App\Traits\Validator;
use JetBrains\PhpStorm\NoReturn;
use Src\Auth;

class AnswerController
{
    use Validator;
    #[NoReturn] public function store(): void
    {
        $answerItems = $this->validate([
            'option_id' => 'required',
            'result_id' => 'required'
        ]);
        $answer = new Answer();
        $answer->create(
            $answerItems['option_id'],
            $answerItems['result_id']
        );
        apiResponse([
            'message' => 'Answer created successfully'
        ]);
    }
}