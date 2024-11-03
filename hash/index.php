<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=hash2', 'root', '');
$tweets = $pdo->query("SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC");

// Init le token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // token csrf aléaroire
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Clone</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .tweet { padding: 10px; border-bottom: 1px solid #ddd; }
        .tweet strong { color: #555; }
        .tweet small { color: #999; display: block; margin-top: 5px; }
        .tweet-actions { margin-top: 5px; }
        .tweet-actions a { margin-right: 5px; color: #007bff; text-decoration: none; }
        .tweet-actions a:hover { text-decoration: underline; }
        form { margin-top: 20px; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 15px; color: #fff; background: #007bff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h1>Twitter Clone</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_id']) ?></strong> (<?= $_SESSION['role'] ?>) ! <a href="logout.php">Se déconnecter</a></p>
    <?php else: ?>
        <p><a href="register.php">S'inscrire</a> | <a href="login.php">Se connecter</a></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="post_tweet.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <textarea name="content" placeholder="Exprimez-vous..." required></textarea>
            <button type="submit">Tweeter</button>
        </form>
    <?php endif; ?>

    <h2>Tweets récents</h2>
    <?php while ($tweet = $tweets->fetch()): ?>
        <div class="tweet">
            <strong><?= htmlspecialchars($tweet['username']) ?></strong> : <?= htmlspecialchars($tweet['content']) ?>
            <small>Publié le : <?= $tweet['created_at'] ?></small>

            <?php if (
                isset($_SESSION['user_id']) && 
                ($_SESSION['user_id'] == $tweet['user_id'] || (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'))
            ): ?>
                <div class="tweet-actions">
                    <a href="edit_tweet.php?id=<?= $tweet['id'] ?>">Modifier</a>
                    <a href="delete_tweet.php?id=<?= $tweet['id'] ?>">Supprimer</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

</div>

</body>
</html>
