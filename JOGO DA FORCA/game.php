<?php
    session_start();
    include 'includes/header.php';
    include 'classes/Database.php';
    include 'classes/Word.php';

    if (!isset($_SESSION['word'])) {
        $db = new Database();
        $wordObj = new Word($db->getConnection());
        $_SESSION['word'] = $wordObj->getRandomWord();
        $_SESSION['guessed'] = [];
        $_SESSION['attempts'] = 0;
    }

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
        <div id="head" class="part">O</div> 
        <div id="leftArm" class="part">/</div>
        <div id="rightArm" class="part">\</div>
        <div id="body" class="part">|</div>
        <div id="leftLeg" class="part">/</div>
        <div id="rightLeg" class="part">\</div>
    </div>

    <script src="js/script.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>
