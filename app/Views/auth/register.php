<div class="auth-container">
    <h2>Inscription</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="/register" class="auth-form">
        <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" required class="form-control">
                <option value="patient">Patient</option>
                <option value="medecin">Médecin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <p class="auth-links">
        Déjà un compte ? <a href="/login">Se connecter</a>
    </p>
</div>