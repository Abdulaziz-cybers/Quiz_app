<?php

namespace App\Models;

use App\Models\DB;

class Quiz extends DB
{
    public function create(int $userId, string $title, string $description, int $timeLimit): false|string
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

    public function update(int $quizId, string $title, string $description, int $timeLimit): false|string
    {
        $query = "UPDATE quizzes SET title = :title,description = :description,time_limit = :timeLimit,updated_at = NOW() WHERE id = :quizId";
        $this->pdo->prepare($query)->execute([
            ':quizId' => $quizId,
            ':title' => $title,
            ':description' => $description,
            ':timeLimit' => $timeLimit
        ]);
        return $this->pdo->lastInsertId();
    }

    public function delete(int $quizId): bool
    {
        $query = "DELETE FROM quizzes WHERE id = :quizId";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':quizId' => $quizId]);
    }

    public function getByUserId(int $userId): false|array
    {
        $query = "SELECT * FROM quizzes WHERE user_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll();
    }

    public function find(int $quizId)
    {
        $query = "SELECT * FROM quizzes WHERE id = :quizId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':quizId' => $quizId]);
        return $stmt->fetch();
    }

}