<?php
$title = "Librairie";
ob_start();
?>
<div class="albums-wrapper">
    <?php foreach ($albums as $album) {
        echo $album->render();
    } ?>
</div>

<?php
$content = ob_get_clean();
include 'baseLayout.php';
?>