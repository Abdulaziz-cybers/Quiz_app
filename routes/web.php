<?php

use Src\Router;
use App\Http\Controllers\Web\HomeController;

Router::get('/', [HomeController::class, 'home']);