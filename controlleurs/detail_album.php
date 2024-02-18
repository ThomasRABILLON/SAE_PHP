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
    $note = Connection::getNoteAlbum($get['id_album'], $_SESSION['user']->getEmail());
    require 'templates/detail_album.php';
}

function addNoteAlbum($get) 
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
    Connection::insertNoteAlbum($get['id_album'], $_SESSION['user']->getEmail(), $get['note']);
    header('Location: /detail_album?id_album=' . $get['id_album']);
    exit();
}