<?php

namespace App\Models;

use app\Models\DB;

class Quiz extends DB
{
    public function create(int $userId,string $title,string $description,int $timeLimit): false|string
    {
        $query = "INSERT INTO quizzes (user_id,title,description,time_limit,updated_at,created_at) 
                VALUES (:userId,:title,:description,:timeLimit,NOW(),NOW())";
        $this->pdo->prepare($query)->execute([
            ':userId' => $userId,
            ':title' => $title,
            ':description' => $description,
            ':timeLimit' => $timeLimit
        ]);
        return $this->pdo->lastInsertId();
    }
}