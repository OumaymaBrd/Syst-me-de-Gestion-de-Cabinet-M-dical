<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/" class="navbar-brand">Cabinet Médical</a>
            <div class="navbar-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/logout">Déconnexion</a>
                <?php else: ?>
                    <a href="/login">Connexion</a>
                    <a href="/register">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container">
        <?php echo $content; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Cabinet Médical. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>