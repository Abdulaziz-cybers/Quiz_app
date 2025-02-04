<?php

namespace App\Models;

use App\Models\DB;

class Answer extends DB
{
    public function find(int $id){
        $sql = "SELECT * FROM `answers` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function create(int $optionId,int $resultId): bool
    {
        $sql = "INSERT INTO `answers` (`option_id`, `result_id`) VALUES (:optionId, :resultId)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
                    ':optionId' => $optionId,
                    ':resultId' => $resultId
                ]);
    }
    public function getCorrectAnswers(int $userId, int $quizId)
    {
        $sql = "SELECT count(answers.id)
                    FROM answers
                            JOIN results ON answers.result_id = results.id
                            JOIN options ON answers.option_id = options.id
                    WHERE results.user_id = :userId
                           AND results.quiz_id = :quizId
                           AND options.is_true = TRUE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':userId' => $userId,
            ':quizId' => $quizId]);
        return $stmt->fetchColumn();
    }
}