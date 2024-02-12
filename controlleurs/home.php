<?php

use App\Models\Builder;
use App\Models\Parser\Yaml;

function home()
{
    $albums = Builder::buildFromJson(Yaml::parse('data/yml/extrait.yml'))['albums'];
    require 'templates/home.php';
}