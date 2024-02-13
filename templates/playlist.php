<?php
$title = "Playliste : " . $playlist->getNom();
ob_start();
?>

<?php
echo $playlist->render();
?>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>