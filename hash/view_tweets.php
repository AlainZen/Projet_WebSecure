<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=hash2', 'root', '');
$stmt = $pdo->query("SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC");

while ($tweet = $stmt->fetch()) {
    echo "<div><strong>" . htmlspecialchars($tweet['username']) . "</strong>: " . htmlspecialchars($tweet['content']) . "</div>";

    // Afficher les boutons Modifier et Supprimer uniquement si c'est l'auteur du tweet mtn admin aussi
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $tweet['user_id']) {
        echo "<a href='edit_tweet.php?id=" . $tweet['id'] . "'>Modifier</a>";
        echo "<a href='delete_tweet.php?id=" . $tweet['id'] . "'>Supprimer</a>";
    }
    echo "<hr>";
}
?>
