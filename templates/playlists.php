<?php
$title = 'Mes playlistes';
ob_start();
?>

<?php
foreach ($playlists as $playlist) {
    echo "<h2><a href=''>" . $playlist->getNom() . "</a></h2>";
}
?>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>