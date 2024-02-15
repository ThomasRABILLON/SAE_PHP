<?php
$title = "9h4quarts - Artistes suivis";
ob_start();
?>

<h1>Artistes suivi</h1>
<?php
if (count($artistes) == 0) {
    echo "<h2>Vous ne suivez aucun artiste</h2>";
} else {
    foreach ($artistes as $artiste) {
        echo "<p>" . $artiste->getNomDeScene() . "</p>";
        echo "<button onclick='window.location.href=`/artiste_suivi/sup?id_art=". $artiste->getId() ."`'>Ne plus suivre</button>";
    }
}
?>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>