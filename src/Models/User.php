<?php

namespace App\Models;

use App\Traits\HasApiTokens;
use Random\RandomException;

class User extends DB
{
    use HasApiTokens;

    /**
     * @throws RandomException
     */
    public function createUser(string $name, string $email, string $password): bool
    {
        $sql = "INSERT INTO users (full_name, email, password,created_at,updated_at) VALUES (:name, :email, :password,NOW(),NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
        $userId = $this->pdo->lastInsertId();
        $this->createApiToken($userId);
        return true;
    }
    public function getUsers(string $email, string $password){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}