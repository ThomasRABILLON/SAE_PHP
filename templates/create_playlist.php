<?php
$title = '9h4quarts - Créer une playlist';
ob_start();
?>

<form action="" method="post">
    <div class="form-group">
        <label for="nom">Nom de la playlist</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<?php
$content = ob_get_clean();
require 'baseLayout.php';
?>