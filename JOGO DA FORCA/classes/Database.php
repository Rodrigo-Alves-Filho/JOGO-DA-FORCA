<?php
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../db/words.db');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->pdo;
    }
}
