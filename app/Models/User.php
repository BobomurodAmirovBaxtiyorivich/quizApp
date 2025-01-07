<?php

namespace App\Models;

use App\Traits\HasAPIToken;
use Random\RandomException;

class User extends DB
{
    use HasAPIToken;
    protected string $query;
    
    protected $stmt;
    
    /**
* @throws RandomException
*/
    public function create(string $fullName, string $email, string $password):bool {
        $this->query = "INSERT INTO users (full_name, email, password, created_at) VALUES (:full_name, :email, :password, NOW())";
        $this->conn->prepare($this->query)->execute([
            ':full_name' => $fullName,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        $userId = $this->conn->lastInsertId();
        $this->createApiToken($userId);
        return true;
    }

    /**
* @throws RandomException
*/
    public function getUser(string $email, string $password):bool {
        $this->query = "SELECT * FROM users WHERE email = :email";
        $this->stmt = $this->conn->prepare($this->query);
        $this->stmt->execute([
            ':email' => $email
            ]);
        $user = $this->stmt->fetch();

        if ($user && password_verify($password, $user->password)){
            $this->createApiToken($user->id);
            return true;
        }
        return false;
    }
}