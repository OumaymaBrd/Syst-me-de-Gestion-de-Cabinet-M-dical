<?php ob_start(); ?>

<h2>Liste des Rendez-vous</h2>
<?php if (!empty($appointments)): ?>
    <table>
        <tr>
            <th>Date</th>
            <th><?php echo $_SESSION['role'] === 'patient' ? 'Médecin' : 'Patient'; ?></th>
            <th>Description</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?php echo $appointment['date']; ?></td>
                <td><?php echo $_SESSION['role'] === 'patient' ? $appointment['medecin_nom'] : $appointment['patient_nom']; ?></td>
                <td><?php echo $appointment['description']; ?></td>
                <td><?php echo $appointment['statut']; ?></td>
                <td>
                    <?php if ($_SESSION['role'] === 'patient' && $appointment['statut'] === 'en_attente'): ?>
                        <form method="post" action="<?php echo BASE_URL; ?>?action=update_appointment">
                            <input type="hidden" name="rdv_id" value="<?php echo $appointment['id']; ?>">
                            <input type="date" name="nouvelle_date" value="<?php echo $appointment['date']; ?>" required>
                            <button type="submit">Modifier</button>
                        </form>
                        <form method="post" action="<?php echo BASE_URL; ?>?action=delete_appointment">
                            <input type="hidden" name="rdv_id" value="<?php echo $appointment['id']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?');">Annuler</button>
                        </form>
                    <?php elseif ($_SESSION['role'] === 'medecin'): ?>
                        <form method="post" action="<?php echo BASE_URL; ?>?action=update_appointment">
                            <input type="hidden" name="rdv_id" value="<?php echo $appointment['id']; ?>">
                            <input type="date" name="nouvelle_date" value="<?php echo $appointment['date']; ?>" required>
                            <select name="statut">
                                <option value="en_attente" <?php echo $appointment['statut'] === 'en_attente' ? 'selected' : ''; ?>>En attente</option>
                                <option value="confirme" <?php echo $appointment['statut'] === 'confirme' ? 'selected' : ''; ?>>Confirmé</option>
                                <option value="refuse" <?php echo $appointment['statut'] === 'refuse' ? 'selected' : ''; ?>>Refusé</option>
                                <option value="termine" <?php echo $appointment['statut'] === 'termine' ? 'selected' : ''; ?>>Terminé</option>
                            </select>
                            <button type="submit">Modifier</button>
                        </form>
                    <?php endif; ?>
                    <a href="<?php echo BASE_URL; ?>?action=view_appointment&id=<?php echo $appointment['id']; ?>">Voir détails</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucun rendez-vous trouvé.</p>
<?php endif; ?>

<?php if ($_SESSION['role'] === 'patient'): ?>
    <a href="<?php echo BASE_URL; ?>?action=create_appointment">Prendre un rendez-vous</a>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

