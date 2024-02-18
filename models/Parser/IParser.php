<?php

namespace App\Models\Parser;


/**
 * Interface IParser, permet de parser des données à partir d'un fichier
 */
interface IParser
{
    public static function parse(string $path): array;
}