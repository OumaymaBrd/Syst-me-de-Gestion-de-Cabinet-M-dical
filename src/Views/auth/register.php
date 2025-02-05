<div class="container">
    <h2>Inscription</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="/register" method="post">
        <div class="form-group">
            <label for="name">Nom complet:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle:</label>
            <select id="role" name="role" required>
                <option value="patient">Patient</option>
                <option value="medecin">Médecin</option>
            </select>
        </div>
        <button type="submit" class="btn">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="/login">Se connecter</a></p>
</div>