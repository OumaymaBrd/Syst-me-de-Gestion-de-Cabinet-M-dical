<?php ob_start(); ?>

<h2>Statistiques du Médecin</h2>

<table>
    <tr>
        <th>Type</th>
        <th>Nombre</th>
    </tr>
    <tr>
        <td>Rendez-vous</td>
        <td><?php echo $appointmentsCount; ?></td>
    </tr>
    <tr>
        <td>Consultations</td>
        <td><?php echo $consultationsCount; ?></td>
    </tr>
</table>

<a href="<?php echo BASE_URL; ?>">Retour à l'accueil</a>

<?php $content = ob_get_clean(); ?>
<?php include ROOT_PATH . 'views/layout.php'; ?>

