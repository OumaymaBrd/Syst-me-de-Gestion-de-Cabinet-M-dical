<?php ob_start(); ?>

<h2>Prendre un rendez-vous</h2>
<form method="post">
    <select name="medecin_id" required>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="date" name="date" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <select name="type" required>
        <option value="rendez_vous">Rendez-vous</option>
        <option value="consultation">Consultation</option>
    </select>
    <button type="submit">Prendre rendez-vous</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

