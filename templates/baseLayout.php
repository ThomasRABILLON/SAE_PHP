<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/home.css">
    <title><?= $title ?></title>
</head>
<body>
    <?php
    include 'aside.php';
    ?>
    <main>
        <?= $content ?>
    </main>
    </body>
</html>