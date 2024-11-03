<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // token csrf aléaroire
}

if (isset($_SESSION['user_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Échec de la vérification CSRF. Veuillez réessayer.");
    }

    $content = htmlspecialchars($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $pdo = new PDO('mysql:host=localhost;dbname=hash2', 'root', '');
    $stmt = $pdo->prepare("INSERT INTO tweets (user_id, content) VALUES (:user_id, :content)");
    $stmt->execute(['user_id' => $user_id, 'content' => $content]);

    echo "Tweet posté !";

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
