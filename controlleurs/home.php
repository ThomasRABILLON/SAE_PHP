<?php

use App\Models\Albums\Builder;
use App\Models\Parser\Yaml;

function home()
{
    $albums = Builder::build(Yaml::parse('data/extrait.yml'));
    require 'templates/home.php';
}

function ajoutAlbum()
{
    require 'templates/ajoutAlbum.php';
}