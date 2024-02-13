<?php

use App\Models\Builder;
use App\Models\Parser\Yaml;
use App\Models\DataBase\Connection;

function admin() {
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    $artistes = Builder::createArtistes(Connection::getArtistes());
    $genres = Builder::createGenres(Connection::getAllGenres());
    require 'templates/admin.php';
}