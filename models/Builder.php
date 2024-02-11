<?php

namespace App\Models;

use App\Models\Classe\Album;
use App\Models\Classe\Artiste;
use App\Models\Classe\Genre;
use App\Models\Classe\Utilisateur;

class Builder
{
    public static function buildFromJson($parsed)
    {
        $albums = [];
        $artistes = [];
        $genres = [];
        foreach ($parsed as $key => $value) {
            $genre = [];
            foreach ($value["genre"] as $v) {
                $genre[] = new Genre(
                    1,
                    $v
                );
            }
            $genres[] = $genre;

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
        return $albums;
    }

    public static function createUserFromDatabase($user)
    {
        return new Utilisateur(
            $user['id'],
            $user['nom'],
            $user['prenom'],
            $user['dateNaissance'],
            $user['mdp']
        );
    }
}