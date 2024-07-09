<?php
include 'includes/header.php';
include 'classes/Database.php';
include 'classes/Word.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $word = new Word($db->getConnection());
    $word->addWord($_POST['word']);
    echo "Palavra adicionada com sucesso!";
}
?>

<form method="POST" action="add_word.php">
    <label for="word">Nova Palavra:</label>
    <input type="text" id="word" name="word" required>
    <button type="submit">Adicionar Palavra</button>
</form>

<?php include 'includes/footer.php'; ?>