<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=hash2', 'root', '');

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $tweet_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM tweets WHERE id = :id");
    $stmt->execute(['id' => $tweet_id]);
    $tweet = $stmt->fetch();

    if ($tweet && ($_SESSION['user_id'] == $tweet['user_id'] || $_SESSION['role'] == 'admin')) {
        $stmt = $pdo->prepare("DELETE FROM tweets WHERE id = :id");
        $stmt->execute(['id' => $tweet_id]);
        echo "Tweet supprimé !";
    } else {
        die("Accès refusé.");
    }
}
?>
