<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function apiResponse($data, $status=200): void
{
    header('Content-type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}
function view(string $page, array $data = []): void
{
    extract($data);
    require 'resources/views/' . $page . '.php';
}
