<?php

namespace App\Models\Parser;

class Yaml implements IParser
{
    public static function parse(string $path): array
    {
        $data = file($path);
        $parsed = [];
        $album = [];
        foreach ($data as $key => $value) {
            if (str_starts_with($value, '-')) {
                if (count($album) != 0) array_push($parsed, $album);
                $album = [];
                $value = str_replace('-', '', $value);
            }
            $val = explode(':', $value);
            $album[trim($val[0])] = trim($val[1]);
        }
        array_push($parsed, $album);
        return $parsed;
    }
}