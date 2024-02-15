<?php
$title = "Librairie";
ob_start();
?>
<link rel="stylesheet" href="./static/librairie.css">
<form class="chercher_album" action="/home" method="get">
    <input type="text" name="recherche" placeholder="Rechercher un album">
    <button type="submit">Rechercher</button>
</form>
<div class="albums-wrapper">
    <?php foreach ($albums as $album) {
        echo $album->render();
    } ?>
</div>

<?php
$content = ob_get_clean();
include 'baseLayout.php';
?>