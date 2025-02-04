<?php

namespace App\Models;

use App\Models\DB;

class Result extends DB
{
    public function create(int $userId, int $quizId, int $limit)
    {
        $query = "INSERT INTO results (user_id, quiz_id, started_at, finished_at) VALUES(:userId, :quizId, NOW(), :finishedAt)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'userId' => $userId,
            'quizId' => $quizId,
            'finishedAt' => date("Y-m-d H:i:s", strtotime("+ $limit minutes")),
        ]);
        $resultId = $this->pdo->lastInsertId();
        return $this->find($resultId);
    }
    public function find(int $id){
        $query = "SELECT * FROM results WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function getUserResult(int $userId, int $quizId){
        $query = "SELECT * FROM results WHERE user_id = :userId AND quiz_id = :quizId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':userId' => $userId,
            ':quizId' => $quizId
        ]);
        return $stmt->fetch();
    }
    public function update(int $id,int $timeTaken)
    {
        $result = $this->find($id);
        $query = "UPDATE results SET finished_at = :timeTaken WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':timeTaken' => date('Y-m-d H:i:s', strtotime($result->started_at) + $timeTaken),
            ':id' => $id
        ]);
        return $this->find($id);
    }
}