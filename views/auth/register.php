<?php ob_start(); ?>

<h2>Inscription</h2>
<form method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <select name="role" required>
        <option value="patient">Patient</option>
        <option value="medecin">Médecin</option>
    </select>
    <button type="submit">S'inscrire</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php include '../views/layout.php'; ?>

