<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$letter = $data['letter'];
$word = $_SESSION['word'];
$guessed = $_SESSION['guessed'];
$attempts = $_SESSION['attempts'];

if (!in_array($letter, $guessed)) {
    $guessed[] = $letter;
    $_SESSION['guessed'] = $guessed;
    
    if (!in_array($letter, str_split($word))) {
        $attempts++;
        $_SESSION['attempts'] = $attempts;
    }
}

$hiddenWord = '';
for ($i = 0; $i < strlen($word); $i++) {
    $hiddenWord .= in_array($word[$i], $guessed) ? $word[$i] . ' ' : '_ ';
}

$response = [
    'success' => true,
    'hiddenWord' => $hiddenWord,
    'attempts' => $attempts,
    'won' => !strstr($hiddenWord, '_'),
    'lost' => $attempts >= 6
];

if ($response['won'] || $response['lost']) {
    include 'classes/Database.php';
    include 'classes/Word.php';
    $db = new Database();
    $wordObj = new Word($db->getConnection());
    $wordObj->updateWordStats($word, $response['won']);
    session_destroy();  
}

echo json_encode($response);
