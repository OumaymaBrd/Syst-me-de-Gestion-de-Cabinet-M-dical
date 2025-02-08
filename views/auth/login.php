<?php ob_start(); ?>

<h2>Connexion</h2>
<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php include '../views/layout.php'; ?>

