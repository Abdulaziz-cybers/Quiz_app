<?php

namespace Src;

use app\Models\DB;
use PDO;

class Auth
{
    public static function check(): mixed
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            apiResponse(['message' => 'Unauthorized'],401);
        }
        if (!str_starts_with($headers['Authorization'], 'Bearer ')) {
            apiResponse([
                'message' => 'Authorization format is invalid, allowed format is Bearer'
            ],400);
        }
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $pdo = (new DB())->getConnection();
        $query = "SELECT * FROM user_api_token WHERE token=:token";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch();
        if (!$user) {
            apiResponse(['message' => 'Unauthorized'],403);
        }
        return $user;
    }
}