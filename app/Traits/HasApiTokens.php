<?php

namespace App\Traits;

use Random\RandomException;

trait HasApiTokens
{
    public string $apiToken;

    /**
     * @throws RandomException
     */
    public function createApiToken(int $userId): bool
    {
        $this->apiToken = bin2hex(random_bytes(40));
        $sql = "INSERT INTO user_api_tokens (user_id,token,expires_at,created_at) VALUES (:user_id,:token,:expires_at,NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'user_id' => $userId,
            'token' => $this->apiToken,
            'expires_at' => date('Y-m-d H:i:s',strtotime("+7 day"))
        ]);
    }
}