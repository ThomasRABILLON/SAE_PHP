<?php
session_start();
$title = "Home";
ob_start();
?>

<div class="container-sm mt-5">
    <?php foreach ($albums as $album) {
        echo $album->render();
    } ?>
</div>

<?php
$content = ob_get_clean();
include 'baseLayout.php';
?>