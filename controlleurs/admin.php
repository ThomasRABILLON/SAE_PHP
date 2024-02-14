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

function updateAlbum($post) {
    $album = Builder::createAlbum(Connection::getAlbum($post['id_album']));
    $album->setTitle($post['title']);
    Connection::updateAlbum($album);
    header('Location: /admin');
}

function updateArtiste($post) {
    $artiste = Builder::createArtiste(Connection::getArtiste($post['id_art']));
    $artiste->setNomDeScene($post['nomDeScene']);
    $artiste->setNom($post['nom']);
    $artiste->setPrenom($post['prenom']);
    Connection::updateArtiste($artiste);
    header('Location: /admin');
}

function createAlbum($post) {
    Connection::insertAlbum($post);
    header('Location: /admin');
}

function createArtiste($post) {
    Connection::insertArtiste($post);
    header('Location: /admin');
}