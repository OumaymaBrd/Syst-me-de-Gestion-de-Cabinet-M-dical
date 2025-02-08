<?php ob_start(); ?>

<h2>Détails du Rendez-vous</h2>

<div id="appointment-details">
    <table>
        <tr>
            <th>Date</th>
            <td><?php echo htmlspecialchars($appointment['date']); ?></td>
        </tr>
        <tr>
            <th>Patient</th>
            <td><?php echo htmlspecialchars($appointment['patient_nom']); ?></td>
        </tr>
        <tr>
            <th>Médecin</th>
            <td><?php echo htmlspecialchars($appointment['medecin_nom']); ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?php echo nl2br(htmlspecialchars($appointment['description'])); ?></td>
        </tr>
        <tr>
            <th>Statut</th>
            <td id="status-display"><?php echo htmlspecialchars($appointment['statut']); ?></td>
        </tr>
    </table>

    <?php if ($_SESSION['role'] === 'medecin'): ?>
        <div class="form-group">
            <h3>Modifier le statut du rendez-vous</h3>
            <form id="update-form" method="post" onsubmit="return handleUpdateSubmit(event);">
                <input type="hidden" name="rdv_id" value="<?php echo (int)$appointment['id']; ?>">
                <select name="statut" id="new-status">
                    <option value="confirme" <?php echo $appointment['statut'] === 'confirme' ? 'selected' : ''; ?>>Confirmé</option>
                    <option value="termine" <?php echo $appointment['statut'] === 'termine' ? 'selected' : ''; ?>>Terminé</option>
                </select>
                <button type="submit">Modifier le statut</button>
            </form>
        </div>
    <?php endif; ?>

    <div id="success-message" style="display: none; color: green; margin-top: 10px;"></div>

    <div class="actions">
        <a href="<?php echo htmlspecialchars(BASE_URL . '?action=appointments'); ?>" class="btn btn-secondary">
            Retour à la liste des rendez-vous
        </a>
    </div>
</div>

<script>
function handleUpdateSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    
    // Convert FormData to URL-encoded string
    const data = new URLSearchParams(formData).toString();
    
    // Make the AJAX request
    ajaxRequest(
        '<?php echo BASE_URL; ?>?action=update_appointment',
        'POST',
        data,
        function(response) {
            if (response.success) {
                document.getElementById('success-message').textContent = response.message;
                document.getElementById('success-message').style.display = 'block';
                document.getElementById('status-display').textContent = formData.get('statut');
            } else {
                alert('Erreur: ' + response.message);
            }
        },
        function(error) {
            alert('Erreur: ' + error);
        }
    );
    
    return false;
}
</script>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

