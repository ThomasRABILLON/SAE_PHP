<?php

use App\Models\Builder;
use App\Models\DataBase\Connection;

function playlists()
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    $playlists = Builder::createPlaylistFromDatabase(Connection::getPlaylistUser($_SESSION['user']));
    require 'templates/playlists.php';
}

function createPlaylist($post)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    if (isset($post['nom'])) {
        Connection::createPlaylist($post['nom'], $_SESSION['user']);
        header('Location: /playlists');
        exit();
    }
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    require 'templates/create_playlist.php';
}