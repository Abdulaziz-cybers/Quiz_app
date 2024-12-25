<?php

namespace App\Models;

class DB
{
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    public \PDO $pdo;

    public function __construct(){
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];

        $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password,
        [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ]);
    }
}