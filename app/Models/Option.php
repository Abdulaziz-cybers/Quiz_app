<?php

namespace App\Models;

use app\Models\DB;

class Option extends DB
{
    public function create(int $quizId,string $title,bool $isTrue): bool
    {
        $query = "INSERT INTO options (question_id,text,is_true,updated_at,created_at) 
                VALUES (:quizId,:text,:isTrue,NOW(),NOW())";
        return $this->pdo->prepare($query)->execute([
            ':quizId' => $quizId,
            ':text' => $title,
            ':isTrue' => $isTrue ? 1 : 0
        ]);
    }
}