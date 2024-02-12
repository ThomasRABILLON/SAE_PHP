<?php
$title = "Librairie";
ob_start();
?>
<link rel="stylesheet" href="./static/librairie.css">
<div class="albums-wrapper">
    <?php foreach ($albums as $album) {
        echo $album->librairieRender();
    } ?>
</div>

<?php
$content = ob_get_clean();
include 'baseLayout.php';
?>