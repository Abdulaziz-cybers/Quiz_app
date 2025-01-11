<?php

use Src\Router;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;

Router::get('/', [HomeController::class, 'home']);
Router::get('/about', [HomeController::class, 'about']);
Router::get('/login', [HomeController::class, 'login']);
Router::get('/register', [HomeController::class, 'register']);

Router::get('/dashboard', [UserController::class, 'home']);