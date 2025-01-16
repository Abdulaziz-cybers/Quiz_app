<?php

namespace App\Models;

use app\Models\DB;

class Question extends DB
{
    public function create(int $quizId,string $title): false|string
    {
        $query = "INSERT INTO questions (quiz_id,text,updated_at,created_at) 
                VALUES (:quizId,:text,NOW(),NOW())";
        $this->pdo->prepare($query)->execute([
            ':quizId' => $quizId,
            ':text' => $title
        ]);
        return $this->pdo->lastInsertId();
    }
}