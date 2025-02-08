<?php ob_start(); ?>

<h2>Détails de la Consultation</h2>

<table>
    <tr>
        <th>Date</th>
        <td><?php echo $consultation['date']; ?></td>
    </tr>
    <tr>
        <th>Patient</th>
        <td><?php echo $consultation['patient_nom']; ?></td>
    </tr>
    <tr>
        <th>Médecin</th>
        <td><?php echo $consultation['medecin_nom']; ?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo nl2br($consultation['consultation_description']); ?></td>
    </tr>
    <tr>
        <th>Statut</th>
        <td><?php echo $consultation['consultation_statut']; ?></td>
    </tr>
    <?php if (!empty($consultation['consultation_reponse'])): ?>
        <tr>
            <th>Réponse du médecin</th>
            <td><?php echo nl2br($consultation['consultation_reponse']); ?></td>
        </tr>
    <?php endif; ?>
</table>

<?php if (($consultation['consultation_statut'] === 'repondu' && $_SESSION['role'] === 'patient') || ($consultation['consultation_statut'] === 'en_attente' && $_SESSION['role'] === 'medecin')): ?>
  <h3>Répondre à la consultation</h3>
  <textarea id="consultation-response" placeholder="Votre réponse" required></textarea>
  <button onclick="replyToConsultation(<?php echo $consultation['id']; ?>, document.getElementById('consultation-response').value)">Envoyer la réponse</button>
<?php endif; ?>

<a href="<?php echo BASE_URL; ?>?action=consultations">Retour à la liste des consultations</a>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

