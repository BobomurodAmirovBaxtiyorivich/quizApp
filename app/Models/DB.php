<?php

namespace App\Models;

use PDO;

class DB
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;
    protected PDO $conn;

    public function __construct()
    {
        $this->host = $_ENV['HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->userName = $_ENV['USER_NAME'];
        $this->password = $_ENV['PASSWORD'];

        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->userName, $this->password,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);

        return $this->conn;
    }

    public function getConnection():PDO {
        return $this->conn;
    }
}