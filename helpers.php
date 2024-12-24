<?php

function apiResponse($data): void
{
    header('Content-type: application/json');
    echo json_encode($data);
    exit;
}
