<?php
session_start();
include 'includes/header.php';
include 'classes/Database.php';
include 'classes/Word.php';

// Iniciar um novo jogo se não houver palavra selecionada
if (!isset($_SESSION['word'])) {
    $db = new Database();
    $wordObj = new Word($db->getConnection());
    $_SESSION['word'] = $wordObj->getRandomWord();
    $_SESSION['guessed'] = [];
    $_SESSION['attempts'] = 0;
}

// Preparar a palavra e os espaços para mostrar na tela
$word = $_SESSION['word'];
$guessed = $_SESSION['guessed'];
$hiddenWord = '';

for ($i = 0; $i < strlen($word); $i++) {
    $hiddenWord .= in_array($word[$i], $guessed) ? $word[$i] . ' ' : '_ ';
}
?>

<p id="wordDisplay"><?php echo $hiddenWord; ?></p>
<input type="text" id="letter" maxlength="1">
<button onclick="guessLetter()">Enviar</button>

<div id="hangman">
    <!-- Aqui será desenhado o boneco da forca -->
    <div id="head">O</div>
    <div id="body">|</div>
    <div id="arms">/|\\</div>
    <div id="legs">/ \\</div>
</div>

<script src="js/script.js"></script>

<?php include 'includes/footer.php'; ?>