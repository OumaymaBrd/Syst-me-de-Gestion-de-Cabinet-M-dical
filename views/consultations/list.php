<?php ob_start(); ?>

<h2>Liste des Consultations</h2>
<?php if (!empty($consultations)): ?>
    <table>
        <tr>
            <th>Date</th>
            <th><?php echo $_SESSION['role'] === 'patient' ? 'Médecin' : 'Patient'; ?></th>
            <th>Description</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($consultations as $consultation): ?>
            <tr>
                <td><?php echo $consultation['date']; ?></td>
                <td><?php echo $_SESSION['role'] === 'patient' ? $consultation['medecin_nom'] : $consultation['patient_nom']; ?></td>
                <td><?php echo $consultation['consultation_description']; ?></td>
                <td><?php echo $consultation['consultation_statut']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>?action=view_consultation&id=<?php echo $consultation['id']; ?>">Voir détails</a>
                    <?php if (($consultation['consultation_statut'] === 'repondu' && $_SESSION['role'] === 'patient') || ($consultation['consultation_statut'] === 'en_attente' && $_SESSION['role'] === 'medecin')): ?>
                        <button onclick="openReplyModal(<?php echo $consultation['id']; ?>, '<?php echo htmlspecialchars($consultation['consultation_description']); ?>', '<?php echo htmlspecialchars($consultation['consultation_reponse']); ?>')">Répondre</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucune consultation trouvée.</p>
<?php endif; ?>

<?php if ($_SESSION['role'] === 'patient'): ?>
    <a href="<?php echo BASE_URL; ?>?action=create_consultation">Demander une consultation</a>
<?php endif; ?>

<div id="replyModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeReplyModal()">&times;</span>
        <h2>Répondre à la consultation</h2>
        <div id="consultationDescription"></div>
        <div id="consultationReponse"></div>
        <form method="post" action="<?php echo BASE_URL; ?>?action=reply_consultation">
            <input type="hidden" id="consultation_id" name="rdv_id">
            <textarea name="reponse" placeholder="Votre réponse" required></textarea>
            <button type="submit">Envoyer la réponse</button>
        </form>
    </div>
</div>

<script>
    function openReplyModal(consultationId, description, reponse) {
        document.getElementById('replyModal').style.display = 'block';
        document.getElementById('consultation_id').value = consultationId;
        document.getElementById('consultationDescription').innerText = "Description: " + description;
        document.getElementById('consultationReponse').innerText = reponse ? "Réponse précédente: " + reponse : "";
    }

    function closeReplyModal() {
        document.getElementById('replyModal').style.display = 'none';
    }
</script>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

