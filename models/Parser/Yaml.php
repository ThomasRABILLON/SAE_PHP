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
            $key = trim($val[0]);
            $val = trim($val[1]);
            if ($key == 'genre') {
                $val = str_replace('[', '', $val);
                $val = str_replace(']', '', $val);
                $val = str_replace(' ', '', $val);
                $val = explode(',', $val);
            }
            if ($key == 'releaseYear') {
                $val = date_create_from_format('Y', $val);
            }
            $album[$key] = $val;
        }
        array_push($parsed, $album);
        return $parsed;
    }
}