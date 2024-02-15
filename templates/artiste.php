<?php
$title = "9h4quarts - Artiste : " . $artiste->getNomDeScene();
ob_start();
session_start();
?>
<link rel="stylesheet" href="./static/album_details.css">
<div class="album-details">
    <h2><?= $artiste->getNomDeScene() ?></h2>
    <p>Prénom & nom: <?= $artiste->getPrenom() ?> <?= $artiste->getNom() ?></p>
    <p>Albums:</p>
    <ul>
    <?php foreach ($albums as $arlbum) { ?>
        <li><?= $arlbum->getTitle() ?></li>
    <?php } ?>
    </ul>
    <?php if (!$isFollowed) { ?>
        <button onclick="window.location.href='/artiste_suivi/add?id_art=<?= $artiste->getId() ?>'">Suivre</button>
    <?php } else { ?>
        <button onclick="window.location.href='/artiste_suivi/sup?id_art=<?= $artiste->getId() ?>'">Ne plus suivre</button>
    <?php } ?>
</div>

<?php
$content = ob_get_clean();
require 'templates/baseLayout.php';
?>