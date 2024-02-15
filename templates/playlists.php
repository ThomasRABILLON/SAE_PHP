<?php
$title = '9h4quarts - Mes playlists';
ob_start();
?>
<div class="playlist">
    <?php
    foreach ($playlists as $playlist) {

        echo "<div class='divplaylist'>";
        echo "<h2 class='titreplaylist'><a href='/playlist?id=". $playlist->getId() ."'>" . $playlist->getNom() . "</a></h2><button class='bouttonplaylist' onclick='window.location.href=`/playlists/sup?id=". $playlist->getId() ."`'>Supprimer</button>";
        echo "</div>";
    }
    ?>
</div>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>