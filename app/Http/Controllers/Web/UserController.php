<?php

namespace App\Http\Controllers\Web;

class UserController
{
    public function home(): void{
        view('dashboard/home');
    }
    public function statistics(): void{
        view('dashboard/statistics');
    }
    public function myQuizzes(): void{
        view('dashboard/my-quizzes');
    }
    public function createQuiz(): void{
        view('dashboard/create-quiz');
    }
    public function takeQuiz(): void{
        view('quiz/take-quiz');
    }
    public function update(int $id): void
    {
        view('dashboard/update',['id' => $id]);
    }
}