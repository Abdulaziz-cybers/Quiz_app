<?php

namespace App\Models;

use App\Models\DB;

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
    public function getByQuizId(int $quizId): array
    {
        $question = "SELECT * FROM questions WHERE quiz_id = :quizId";
        $stmt = $this->pdo->prepare($question);
        $stmt->execute([':quizId' => $quizId]);
        $questions = $stmt->fetchAll();

        $questionIds = array_column($questions, 'id');
        $placeholders = rtrim(str_repeat('?,', count($questionIds)), ',');

        $option = "SELECT * FROM options WHERE question_id IN ($placeholders)";
        $stmt = $this->pdo->prepare($option);
        $stmt->execute($questionIds);
        $options = $stmt->fetchAll();

        $groupedOptions = [];
        foreach ($options as $option) {
            $groupedOptions[$option->question_id][] = $option;
        }
        foreach ($questions as &$question) {
            $question->options = $groupedOptions[$question->id] ?? [];
        }
        return $questions;
    }
    public function deleteByQuizId(int $quizId): bool
    {
        $query = "DELETE FROM questions WHERE quiz_id = :quizId";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':quizId' => $quizId]);
    }
}