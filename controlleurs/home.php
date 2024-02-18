<?php

use App\Models\Builder;
use App\Models\Parser\Yaml;
use App\Models\DataBase\Connection;

function home($get)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    if (isset($get['recherche'])) {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::searchAlbums($get['recherche']));
    } else if (isset($get['genre']) && $get['genre'] != 'all') {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbumsFromGenre($get['genre']));
    } else if (isset($get['artiste']) && $get['artiste'] != 'all') {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbumsArtiste($get['artiste']));
    } else if (isset($get['annee']) && $get['annee'] != 'all') {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbumsFromYear($get['annee']));
    } else {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    }
    $genres = Builder::createGenres(Connection::getAllGenres());
    $artistes = Builder::createArtistes(Connection::getArtistes());
    $annees = Connection::getAnnees();
    // $albums = Builder::buildFromJson(Yaml::parse('data/yml/extrait.yml'))['albums'];
    require 'templates/home.php';
}