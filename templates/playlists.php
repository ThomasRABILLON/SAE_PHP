<?php
$title = '9h4quarts - Mes playlists';
ob_start();
?>
<div class="playlist">
    <h1>Mes playlists</h1>
    <div class='albums-wrapper'>
    <?php
    if (empty($playlists)) {
        echo "<h2>Vous n'avez pas encore de playlist</h2>";
    } else {
        foreach ($playlists as $playlist) {
            echo "<div class='album-container'>";
            echo "<h2 class='titreplaylist'><a href='/playlist?id=". $playlist->getId() ."'>" . $playlist->getNom() . "</a></h2><button class='bouttonplaylist' onclick='window.location.href=`/playlists/sup?id=". $playlist->getId() ."`'>Supprimer</button>";
            echo "</div>";
        }
    }
    ?>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>