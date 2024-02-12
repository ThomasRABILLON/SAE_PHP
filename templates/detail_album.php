<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Album Details</title>
</head>

<body>
    <div class="album-details">
        <?php

        // Récupération du nom de l'album depuis l'URL
        $albumId = isset($_GET['album']) ? $_GET['album'] : '';

        // Vérification si l'album existe
        if (array_key_exists($albumId, $albums)) {
            $currentAlbum = $albums[$albumId];

            // Affichage des informations de l'album
            $currentAlbum->displayDetails();
        } else {
            echo '<p>Album non trouvé.</p>';
        }
        ?>
    </div>
</body>

</html>