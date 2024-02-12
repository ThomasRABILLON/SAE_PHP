<?php

use App\Models\Builder;
use App\Models\Parser\Yaml;
use App\Models\DataBase\Connection;

function home()
{
    // $albums = Builder::buildFromJson(Yaml::parse('data/yml/extrait.yml'))['albums'];
    $albums = Builder::createAllAlbumsFromDatabase(Connection::getAlbums());
    require 'templates/home.php';
}