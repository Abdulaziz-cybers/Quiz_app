<?php
require 'resources/views/home.php';
use Src\Router;

if (Router::isApiCall()){
    require 'routes/api.php';
    exit();
}
require 'routes/web.php';
