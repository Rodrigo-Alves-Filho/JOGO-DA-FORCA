<?php
include 'classes/Database.php';
include 'classes/Word.php';

$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $db = new Database();
    $wordObj = new Word($db->getConnection());
    $wordObj->updateWordStats($data['word'], $data['won']);
}

