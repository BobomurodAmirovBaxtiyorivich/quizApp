<?php

namespace App\Traits;

use Random\RandomException;trait HasAPIToken {

    public string $ApiToken;

    /**
* @throws RandomException
*/
    public function createApiToken(int $userId):string {
        $this->ApiToken = bin2hex(random_bytes(40));

        $this->query = "INSERT INTO user_api_token (user_id, token, expires_at, created_at) VALUES (:userId, :token, :expiresAt, NOW())";
        $this->stmt = $this->conn->prepare($this->query);
        $this->stmt->execute([
            ':userId' => $userId,
            ':token' => $this->ApiToken,
            ':expiresAt' => (date("Y-m-d H:i:s", strtotime('+' . $_ENV['API_TOKEN_EXPARITION_DAY'] . 'day')))
            ]);
        return $this->ApiToken;
    }
}