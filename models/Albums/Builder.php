<?php

namespace App\Models\Albums;

class Builder
{
    public static function build($parsed)
    {
        $albums = [];
        foreach ($parsed as $key => $value) {
            $albums[] = new Album(
                $value["entryId"],
                $value["by"],
                $value["title"],
                $value["releaseYear"],
                $value["genre"],
                $value["parent"],
                $value["img"]
            );
        }
        return $albums;
    }
}