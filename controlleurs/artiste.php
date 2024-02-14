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

function artisteSuiviSup($get) 
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    Connection::supArtisteSuivi($_SESSION['user'], $get['id_art']);
    header('Location: /suivi');
    exit();
}

function artisteSuiviAdd($get) 
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    Connection::insertArtisteSuivi($_SESSION['user'], $get['id_art']);
    header('Location: /suivi');
    exit();
}