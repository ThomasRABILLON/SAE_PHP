<?php

use App\Models\Builder;
use App\Models\DataBase\Connection;

function admin() {
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    $artistes = Builder::createArtistes(Connection::getArtistes());
    $genres = Builder::createGenres(Connection::getAllGenres());
    require 'templates/admin.php';
}

function supAlbum($get) {
    Connection::supAlbum($get['id']);
    header('Location: /admin');
}

function supArtiste($get) {
    Connection::supArtiste($get['id']);
    header('Location: /admin');
}