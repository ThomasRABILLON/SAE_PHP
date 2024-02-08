<?php

namespace App\Models;

use App\Models\Classe\Album;
use App\Models\Classe\Artiste;
use App\Models\Classe\Genre;

class Builder
{
    public static function buildFromJson($parsed)
    {
        $albums = [];
        $artistes = [];
        $genres = [];
        foreach ($parsed as $key => $value) {
            $genre = [];
            $genresJson = str_replace("]", "", str_replace("[", "", $value["genre"]));
            foreach ($value["genre"] as $g) {
                $gen = null;
                foreach ($genres as $ge) {
                    if ($ge->getNom() == $g) {
                        $gen = $ge;
                    }
                }
                if ($genre == null) {
                    $last_genre = end($genres);
                    $id_genre = $last_genre == false ? 1 : $last_genre->getId() + 1;
                    $gen = new Genre($id_genre, $g);
                    $genres[] = $gen;
                }
                $genre[] = $gen;
            }
            $artiste = null;
            foreach ($artistes as $a) {
                if ($a->getNomDeScene() == $value["by"]) {
                    $artiste = $a;
                }
            }
            if ($artiste == null) {
                $last_art = end($artistes);
                $id_art = $last_art == false ? 1 : $last_art->getId() + 1;
                $artiste = new Artiste(
                    $id_art,
                    $value["by"],
                    $value["by"],
                    $value["by"]
                );
                $artistes[] = $artiste;
            }
            $albums[] = new Album(
                $value["entryId"],
                $value["title"],
                $value["releaseYear"],
                $value["img"],
                $genre,
                $artiste
            );
        }
        var_dump($genres);
        return $albums;
    }
}