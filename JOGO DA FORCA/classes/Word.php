<?php
class Word {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addWord($word) {
        $stmt = $this->pdo->prepare("INSERT INTO words (word) VALUES (:word)");
        $stmt->bindParam(':word', $word);
        $stmt->execute();
    }

    public function getRandomWord() {
        $stmt = $this->pdo->query("SELECT word FROM words ORDER BY RANDOM() LIMIT 1");
        return $stmt->fetchColumn();
    }

    public function updateWordStats($word, $won) {
        $stmt = $this->pdo->prepare("UPDATE words SET played = played + 1, won = won + :won WHERE word = :word");
        $stmt->bindParam(':won', $won);
        $stmt->bindParam(':word', $word);
        $stmt->execute();
    }
}
