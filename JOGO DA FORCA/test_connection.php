<?php
include 'classes/Database.php';

try {
    $db = new Database();
    $pdo = $db->getConnection();
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}

