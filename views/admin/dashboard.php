<?php ob_start(); ?>

<h2>Tableau de bord administrateur</h2>

<h3>Statistiques</h3>
<p>Nombre total de patients : <?php echo $total_patients; ?></p>
<p>Nombre total de consultations en ligne : <?php echo $total_consultations; ?></p>
<p>Nombre total de rendez-vous terminés : <?php echo $total_rendez_vous; ?></p>

<h3>Gestion des utilisateurs</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['nom']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Gestion des rendez-vous et consultations</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Patient</th>
        <th>Médecin</th>
        <th>Date</th>
        <th>Type</th>
        <th>Description</th>
        <th>Statut</th>
    </tr>
    <?php foreach ($appointments as $appointment): ?>
        <tr>
            <td><?php echo $appointment['id']; ?></td>
            <td><?php echo $appointment['patient_nom']; ?></td>
            <td><?php echo $appointment['medecin_nom']; ?></td>
            <td><?php echo $appointment['date']; ?></td>
            <td><?php echo $appointment['type']; ?></td>
            <td><?php echo $appointment['type'] === 'consultation' ? $appointment['consultation_description'] : $appointment['description']; ?></td>
            <td><?php echo $appointment['type'] === 'consultation' ? $appointment['consultation_statut'] : $appointment['statut']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

