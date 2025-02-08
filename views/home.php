<?php ob_start(); ?>

<h2>Bienvenue au Cabinet Médical</h2>
<p>Prenez rendez-vous en ligne avec nos médecins qualifiés ou demandez une consultation en ligne.</p>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

