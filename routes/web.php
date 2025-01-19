<?php

use Src\Router;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;

Router::get('/', [HomeController::class, 'home']);
Router::get('/about', [HomeController::class, 'about']);
Router::get('/login', [HomeController::class, 'login']);
Router::get('/register', [HomeController::class, 'register']);

Router::get('/dashboard', [UserController::class, 'home']);
Router::get('/statistics', [UserController::class, 'statistics']);
Router::get('/my-quizzes', [UserController::class, 'myQuizzes']);
Router::get('/create-quiz', [UserController::class, 'createQuiz']);
Router::get('/my-quizzes/{id}/update', [UserController::class, 'update']);

Router::get('/take-quiz', [UserController::class, 'takeQuiz']);