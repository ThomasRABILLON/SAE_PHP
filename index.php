<?php

require_once 'models/Autoloader.php';
require_once 'controlleurs/home.php';

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
    case '/ajoutAlbum':
        ajoutAlbum();
        break;
    
    default:
        # code...
        break;
}