<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function apiResponse($data, $status=200): void
{
    header('Content-type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}
function assets(string $path): string
{
    return $_ENV['APP_URL'] . 'public' . $path;
}
function view(string $page, array $data = []): void
{
    extract($data);
    require 'resources/views/' . $page . '.php';
}
function componentsMain(string $component): void{
    require 'resources/views/components/main/' . $component . '.php';
}
function componentsDashboard(string $component): void{
    require 'resources/views/components/dashboard/' . $component . '.php';
}