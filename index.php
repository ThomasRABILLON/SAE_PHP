<?php

require_once 'models/Autoloader.php';
require_once 'controlleurs/home.php';
require_once 'controlleurs/connection.php';
require_once 'controlleurs/profil.php';
require_once 'controlleurs/insert.php';
require_once 'controlleurs/connection.php';
require_once 'controlleurs/profil.php';
require_once 'controlleurs/insert.php';
require_once 'controlleurs/playlists.php';
require_once 'controlleurs/artiste.php';

use App\Models\Autoloader;

Autoloader::register();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        home();
        break;
    case '/home':
        home();
        break;
    case '/register':
        register($_POST);
        break;
    case '/login':
        login($_POST);
        break;
    case '/logout':
        logout();
        break;
    case '/profil':
        profil($_POST);
        break;
    case '/insert':
        insert();
        break;
    case '/playlists':
        playlists();
        break;
    case '/create_playlist':
        createPlaylist($_POST);
        break;
    case '/playlists/sup':
        supPlaylist($_GET);
        break;
    case '/playlist':
        playlist($_GET['id']);
        break;
    case '/suivi':
        artistesSuivi();
        break;
    default:
        # code...
        break;
}