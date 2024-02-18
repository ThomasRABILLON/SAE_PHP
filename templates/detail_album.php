<?php
$title = "9h4quarts - Album : " . $album->getTitle();
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
    <p>Artiste: <a href="/artiste?id_art=<?= $album->getArtiste()->getId() ?>"><?= $album->getArtiste()->getNomDeScene() ?></a></p>
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
    <p>Note: <?php if (!$note) { ?>
        <select name="note" id="note">
            <option value="">Pas de note</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    <?php } else {
        echo $note['note'] . '/5';
    } ?>
    </p>
</div>

<script defer>
    let playlists = document.getElementById('playlist');
    let note = document.getElementById('note');
    
    if (playlists) {
        playlists.addEventListener('change', function() {
            window.location.href = '/playlist/add?id_playlist=' + this.value + '&id_album=<?= $album->getId() ?>';
        });
    }

    if (note) {
        note.addEventListener('change', function() {
            window.location.href = '/album/note/add?id_album=<?= $album->getId() ?>&note=' + this.value;
        });
    }
</script>

<?php
$content = ob_get_clean();
require 'templates/baseLayout.php';
?>