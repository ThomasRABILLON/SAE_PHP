<?php

namespace App\Models;

use App\Models\Classe\Album;
use App\Models\Classe\Artiste;
use App\Models\Classe\Genre;
use App\Models\Classe\Utilisateur;
use App\Models\Database\Connection;

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
                $genre[] = new Genre(strtolower($v));
            }
            foreach ($genre as $g) {
                array_push($genres, $g);
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
        return [
            "albums" => $albums,
            "artistes" => $artistes,
            "genres" => $genres
        ];
    }

    public static function createUserFromDatabase(array $user)
    {
        return new Utilisateur(
            $user['email'],
            $user['nom'],
            $user['prenom'],
            date_create($user['date_naissance']),
            $user['mdp']
        );
    }

    public static function createArtiste(array $artiste)
    {
        return new Artiste(
            $artiste['id'],
            $artiste['nom_de_scene'],
            $artiste['nom'],
            $artiste['prenom']
        );
    }

    public static function createGenre(array $genre)
    {
        return new Genre(
            $genre['libelle_genre']
        );
    }

    public static function createAllAlbumsFromDatabase(array $albums)
    {
        $allAlbums = [];
        foreach ($albums as $album) {
            $genres = [];
            foreach (Connection::getAllGenresAlbum($album['id_album']) as $genre) {
                $genres[] = Builder::createGenre($genre);
            }
            $allAlbums[] = new Album(
                $album['id_album'],
                $album['title'],
                $album['release_date'],
                $album['img'],
                $genres,
                Builder::createArtiste(Connection::getArtiste($album['id_art']))
            );
        }
        return $allAlbums;
    }
}