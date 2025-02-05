<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>Cabinet Médical</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <?php echo $content; ?>
    </main>

    <?php include 'footer.php'; ?>

    <script src="/assets/js/validation.js"></script>
</body>
</html>