<?php
include 'classes/Database.php';

try {
    $db = new Database();
    $pdo = $db->getConnection();

    // Criação da tabela 'words'
    $sql = "CREATE TABLE IF NOT EXISTS words (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        word TEXT NOT NULL,
        played INTEGER DEFAULT 0,
        won INTEGER DEFAULT 0
    )";

    $pdo->exec($sql);
    echo "Tabela 'words' criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}

