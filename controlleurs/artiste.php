<?php

use App\Models\DataBase\Connection;
use App\Models\Builder;

function artistesSuivi() 
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    $artistes = Builder::createArtitesSuivi(Connection::getArtistesSuivi($_SESSION['user']));
    require 'templates/artistesSuivi.php';
}