<?php ob_start(); ?>

<h2>Demander une consultation</h2>
<form method="post">
    <select name="medecin_id" required>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <textarea name="description" placeholder="Description de votre problème" required></textarea>
    <button type="submit">Demander une consultation</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php include '../views/layout.php'; ?>

