<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
</head>
<body>
    <header>
        <h1>Cabinet Médical</h1>
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>">Accueil</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="<?php echo BASE_URL; ?>?action=register">Inscription</a></li>
                    <li><a href="<?php echo BASE_URL; ?>?action=login">Connexion</a></li>
                <?php else: ?>
                    <?php if ($_SESSION['role'] === 'patient'): ?>
                        <li><a href="<?php echo BASE_URL; ?>?action=appointments">Rendez-vous</a></li>
                        <li><a href="<?php echo BASE_URL; ?>?action=consultations">Consultations</a></li>
                    <?php elseif ($_SESSION['role'] === 'medecin'): ?>
                        <li><a href="<?php echo BASE_URL; ?>?action=appointments">Rendez-vous</a></li>
                        <li><a href="<?php echo BASE_URL; ?>?action=consultations">Consultations</a></li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>?action=statistics">
                                Statistiques
                                <?php
                                $medecin = new Medecin($_SESSION['user_id']);
                                $appointmentsCount = $medecin->countAppointments();
                                $consultationsCount = $medecin->countConsultations();
                                echo "($appointmentsCount RDV, $consultationsCount Consult.)";
                                ?>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="<?php echo BASE_URL; ?>?action=admin_dashboard">Administration</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL; ?>?action=logout">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Cabinet Médical. Tous droits réservés.</p>
    </footer>

    <script src="<?php echo BASE_URL; ?>/js/main.js"></script>
    <script src="<?php echo BASE_URL; ?>/js/ajax.js"></script>
</body>
</html>

