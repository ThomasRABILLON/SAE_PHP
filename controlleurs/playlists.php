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
    $playlists = Builder::createAllPlaylistFromDatabase(Connection::getPlaylistUser($_SESSION['user']));
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

function supPlaylist($get)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    if (isset($get['id'])) {
        Connection::supPlaylist($get['id']);
        header('Location: /playlists');
        exit();
    }
}

function playlist($id)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    $playlist = Builder::createPlaylistFromDatabase(Connection::getPlaylist($id));
    require 'templates/playlist.php';
}

function playlistAddAlbum($get)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    echo "a";
    var_dump($get);
    if (isset($get['id_playlist']) && isset($get['id_album'])) {
        Connection::insertAlbumInPlaylist($get['id_playlist'], $get['id_album']);
        header('Location: /playlist?id=' . $get['id_playlist']);
        exit();
    }
}

function playlistSupAlbum($get)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    if (isset($get['id_playlist']) && isset($get['id_album'])) {
        if (Connection::getAlbumInPlaylist($get['id_playlist'], $get['id_album'])) {
            Connection::supAlbumInPlaylist($get['id_playlist'], $get['id_album']);
        }
        header('Location: /playlist?id=' . $get['id_playlist']);
        exit();
    }
}