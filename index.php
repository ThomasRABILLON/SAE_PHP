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
    case '/librairie':
        librairie();
        break;
    default:
        # code...
        break;
}