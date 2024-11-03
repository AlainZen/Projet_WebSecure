<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=hash2', 'root', '');

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $tweet_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM tweets WHERE id = :id");
    $stmt->execute(['id' => $tweet_id]);
    $tweet = $stmt->fetch();

    if ($tweet && ($_SESSION['user_id'] == $tweet['user_id'] || $_SESSION['role'] == 'admin')) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $content = htmlspecialchars($_POST['content']);
            $stmt = $pdo->prepare("UPDATE tweets SET content = :content WHERE id = :id");
            $stmt->execute(['content' => $content, 'id' => $tweet_id]);
            echo "Tweet modifié !";
        }
    } else {
        die("Accès refusé.");
    }
}
?>

<form method="POST" action="edit_tweet.php?id=<?= $tweet_id ?>">
    <textarea name="content" required><?= htmlspecialchars($tweet['content']) ?></textarea>
    <button type="submit">Modifier</button>
</form>
