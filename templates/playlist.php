<?php
$title = "9h4quarts - Playlist : " . $playlist->getNom();
ob_start();
?>

<?php
echo $playlist->render();
?>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>