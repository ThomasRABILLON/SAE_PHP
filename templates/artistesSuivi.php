<?php
$title = "Artistes suivis";
ob_start();
?>

<h1>Artistes suivi</h1>
<?php
if (count($artistes) == 0) {
    echo "<p>Vous ne suivez aucun artiste</p>";
} else {
    foreach ($artistes as $artiste) {
        echo "<p>" . $artiste->getNomDeScene() . "</p>";
    }
}
?>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>