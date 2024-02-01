<?php

namespace App\Models\Parser;

interface IParser
{
    public static function parse(string $path): array;
}