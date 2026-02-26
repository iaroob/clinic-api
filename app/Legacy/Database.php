<?php

namespace App\Legacy;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = env('DB_HOST', '127.0.0.1');
        $db   = env('DB_DATABASE', 'clinic');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '');
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}