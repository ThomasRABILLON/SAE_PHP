<?php
$title = 'Mes playlistes';
ob_start();
?>

<div>
<?php
echo "<h1>Playlistes</h1>";
if (empty($playlists)) {
    echo "<h2>Vous n'avez pas de playliste</h2>";
}
foreach ($playlists as $playlist) {
    echo "<h2><a href='/playlist?id=". $playlist->getId() ."'>" . $playlist->getNom() . "</a></h2><button onclick='window.location.href=`/playlists/sup?id=". $playlist->getId() ."`'>Suprimer</button>";
}
?>
</div>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>