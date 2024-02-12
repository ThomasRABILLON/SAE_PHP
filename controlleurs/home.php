<?php

use App\Models\Builder;
use App\Models\Parser\Yaml;

function home()
{
    $albums = Builder::buildFromJson(Yaml::parse('data/yml/extrait.yml'))['albums'];
    require 'templates/home.php';
}

function librairie(){
    $albums = Builder::build(Yaml::parse('data/extrait.yml'));
    require 'templates/librairie.php';
}