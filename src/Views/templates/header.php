<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <li><a href="/admin/dashboard">Tableau de bord</a></li>
                    <?php elseif ($_SESSION['user_role'] === 'patient'): ?>
                        <li><a href="/patient/profile">Profil</a></li>
                    <?php elseif ($_SESSION['user_role'] === 'medecin'): ?>
                        <li><a href="/medecin/profile">Profil</a></li>
                    <?php endif; ?>
                    <li><a href="/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/login">Connexion</a></li>
                    <li><a href="/register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>