<?php

use App\Models\DataBase\Connection; 

function insert()
{
    try {
        Connection::rightFromYaML('data/yml/extrait.yml');
    } catch (\Throwable $th) {
        header('Location: /admin');
    }
    header('Location: /admin');
}