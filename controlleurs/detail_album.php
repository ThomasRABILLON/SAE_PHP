<?php

use App\Models\Builder;
use App\Models\DataBase\Connection;

function detailAlbum($get) 
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    $playlists = Builder::createAllPlaylistFromDatabase(Connection::getPlaylistUser($_SESSION['user']));
    $album = Builder::createAlbum(Connection::getAlbum($get['id_album']));
    require 'templates/detail_album.php';
}