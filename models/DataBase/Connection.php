<?php

namespace App\Models\Database;

use App\Models\Classe\Utilisateur;
use PDO;
use App\Models\Builder;
use App\Models\Parser\Yaml;

class Connection
{
    public static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO('sqlite:./data/database/9h4quarts.db');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public static function getInstance() : Connection
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public static function rightFromYaML($path)
    {
        $data = Builder::buildFromJson(Yaml::parse($path));
        $pdo = self::getInstance();
        foreach ($data['artistes'] as $artiste) {
            $stmt = $pdo->getPDO()->prepare('INSERT INTO ARTISTES (id_art, nom_de_scene, nom, prenom) VALUES (:id_art, :nom_de_scene, :nom, :prenom)');
            $stmt->bindParam(':id_art', $artiste->getId());
            $stmt->bindParam(':nom_de_scene', $artiste->getNomDeScene());
            $stmt->bindParam(':nom', $artiste->getNom());
            $stmt->bindParam(':prenom', $artiste->getPrenom());
            $stmt->execute();
        }
        foreach ($data['genres'] as $genre) {
            if ($genre->getLibelle() != '') {
                $stmt = $pdo->getPDO()->prepare('SELECT * FROM GENRE WHERE libelle_genre = :libelle_genre');
                $stmt->bindParam(':libelle_genre', $genre->getLibelle());
                $stmt->execute();
                $g = $stmt->fetch();
                if (!$g) {
                    $stmt = $pdo->getPDO()->prepare('INSERT INTO GENRE (libelle_genre) VALUES (:libelle_genre)');
                    $stmt->bindParam(':libelle_genre', $genre->getLibelle());
                    $stmt->execute();
                }
            }
        }
        foreach ($data['albums'] as $album) {
            $stmt = $pdo->getPDO()->prepare('INSERT INTO ALBUMS (id_album, title, release_date, img, id_art) VALUES (:id_album, :title, :release_date, :img, :id_artiste)');
            $stmt->bindParam(':id_album', $album->getId());
            $stmt->bindParam(':title', $album->getTitle());
            $stmt->bindParam(':release_date', date_format($album->getReleaseDate(), 'Y-m-d'));
            $img_path = "./images/" . $album->getImg();
            $stmt->bindParam(':img', $img_path);
            $stmt->bindParam(':id_artiste', $album->getArtiste()->getId());
            $stmt->execute();
            foreach ($album->getGenres() as $genre) {
                $stmt = $pdo->getPDO()->prepare('INSERT INTO A_GENRE (id_album, libelle_genre) VALUES (:id_album, :libelle_genre)');
                $stmt->bindParam(':id_album', $album->getId());
                $stmt->bindParam(':libelle_genre', $genre->getLibelle());
                $stmt->execute();
            }
        }
    }
    
    public static function insertUser($email, $nom, $prenom, $dateNaissance, $mdp)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO UTILISATEURS (email, nom, prenom, date_naissance, mdp) VALUES (:email, :nom, :prenom, :date_naissance, :mdp)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_naissance', $dateNaissance);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
    }

    public static function getUser($email)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM UTILISATEURS WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }

    public static function updateUser($user)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('UPDATE UTILISATEURS SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE id_user = :id_user');
        $stmt->bindParam(':nom', $user->getNom());
        $stmt->bindParam(':prenom', $user->getPrenom());
        $stmt->bindParam(':date_naissance', date_format($user->getDateNaissance(), 'Y-m-d'));
        $stmt->bindParam(':id_user', $user->getId());
        $stmt->execute();
    }

    public static function getAlbums()
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ALBUMS');
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }

    public static function getAlbum($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ALBUMS WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id);
        $stmt->execute();
        $album = $stmt->fetch();
        return $album;
    }

    public static function getArtiste($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ARTISTES WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
        $artiste = $stmt->fetch();
        return $artiste;
    }

    public static function getAllGenresAlbum($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM A_GENRE WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id);
        $stmt->execute();
        $genres = $stmt->fetchAll();
        return $genres;
    }

    public static function getPlaylistUser(Utilisateur $user)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM PLAYLIST WHERE email = :email');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->execute();
        $playlists = $stmt->fetchAll();
        return $playlists;
    }

    public static function getAlbumsFromPlaylist($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM EST_DANS WHERE id_playlist = :id_playlist');
        $stmt->bindParam(':id_playlist', $id);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }

    public static function createPlaylist($nom, Utilisateur $user)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO PLAYLIST (nom, email) VALUES (:nom, :email)');
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->execute();
    }
}