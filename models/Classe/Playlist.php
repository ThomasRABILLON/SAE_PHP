<?php

namespace App\Models\Classe;

class Playlist
{
    private int $id_playlist;
    private string $nom;
    private Utilisateur $utilisateur;
    private array $albums;

    public function __construct(int $id_playlist, string $nom, Utilisateur $utilisateur, array $albums)
    {
        $this->id_playlist = $id_playlist;
        $this->nom = $nom;
        $this->utilisateur = $utilisateur;
        $this->albums = $albums;
    }

    public function getId()
    {
        return $this->id_playlist;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function getAlbums()
    {
        return $this->albums;
    }

    public function addAlbum(Album $album)
    {
        $this->albums[] = $album;
    }

    public function removeAlbum(Album $album)
    {
        $key = array_search($album, $this->albums);
        if ($key !== false) {
            unset($this->albums[$key]);
        }
    }
}