<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuizController;
use Src\Router;

Router::post('/api/register', [UserController::class, 'store']);
Router::post('/api/login', [UserController::class, 'login']);

Router::post('/api/quizzes', [QuizController::class, 'create']);

Router::get('/api/user/getInfo', [UserController::class, 'show'],'auth:api');

Router::notFound();