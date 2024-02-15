<?php
$title = "9h4quarts - Accueil";
ob_start();
?>
<link rel="stylesheet" href="./static/librairie.css">
<form action="/home" method="get">
    <input type="text" name="recherche" placeholder="Rechercher un album">
    <button type="submit">Rechercher</button>
</form>
<select name="genre" id="genre">
    <option value="all">Tous les genres</option>
    <?php foreach ($genres as $genre) {
        if (isset($_GET['genre']) && $_GET['genre'] == $genre->getLibelle()) {
            echo "<option value='{$genre->getLibelle()}' selected>{$genre->getLibelle()}</option>";
            continue;
        }
        echo "<option value='{$genre->getLibelle()}'>{$genre->getLibelle()}</option>";
    } ?>
</select>
<select name="artiste" id="artiste">
    <option value="all">Tous les artistes</option>
    <?php foreach ($artistes as $artiste) {
        if (isset($_GET['artiste']) && $_GET['artiste'] == $artiste->getId()) {
            echo "<option value='{$artiste->getId()}' selected>{$artiste->getNom()}</option>";
            continue;
        }
        echo "<option value='{$artiste->getId()}'>{$artiste->getNom()}</option>";
    } ?>
</select>
<div class="albums-wrapper">
    <?php foreach ($albums as $album) {
        echo $album->render();
    } ?>
</div>

<script>
    document.getElementById('genre').addEventListener('change', function() {
        const genre = this.value;
        window.location.href = `/home?genre=${genre}`;
    });

    document.getElementById('artiste').addEventListener('change', function() {
        const artiste = this.value;
        window.location.href = `/home?artiste=${artiste}`;
    });
</script>

<?php
$content = ob_get_clean();
include 'baseLayout.php';
?>