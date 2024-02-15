<?php

use App\Models\DataBase\Connection; 

function insert()
{
    Connection::rightFromYaML('data/yml/extrait.yml');
    header('Location: /admin');
}