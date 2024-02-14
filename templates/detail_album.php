<?php
$title = "Detail Album";
ob_start();
session_start();
?>
<link rel="stylesheet" href="./static/album_details.css">
<div class="album-details">
    <img src="<?= $album->getImg() ?>" alt="<?= $album->getTitle()?>">
    <h2><?= $album->getTitle() ?></h2>
    <p>Date de sortie: <?= date_format($album->getReleaseDate(), 'Y') ?></p>
    <p>Genres:</p>
    <ul>
    <?php foreach ($album->getGenres() as $genre) { ?>
        <li><?= $genre->getLibelle() ?></li>
    <?php } ?>
    </ul>
    <p>Artiste: <?= $album->getArtiste()->getNomDeScene() ?></p>
    <?php if (!empty($playlists))
    { ?>
        <form action="/detail_album" method="get">
            <label>Ajouter dans la playlsit:</label>
            <select id="playlist" name="playlist">
                <option value="">Aucune playlist</option>
            <?php foreach ($playlists as $playlist) { ?>
                <option value="<?= $playlist->getId() ?>"><?= $playlist->getNom() ?></option>
            <?php } ?>
            </select>
        </form>
    <?php } ?>
</div>

<script>
    document.getElementById('playlist').addEventListener('change', function() {
        window.location.href = '/playlist/add?id_playlist=' + this.value + '&id_album=<?= $album->getId() ?>';
    });
</script>

<?php
$content = ob_get_clean();
require 'templates/baseLayout.php';
?>