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
        require 'templates/home.php';
        return;
    } else {
        $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    }
    // $albums = Builder::buildFromJson(Yaml::parse('data/yml/extrait.yml'))['albums'];
    require 'templates/home.php';
}