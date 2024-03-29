<?php

namespace App\Models\Database;

use App\Models\Classe\Utilisateur;
use PDO;
use App\Models\Builder;
use App\Models\Parser\Yaml;


/**
 * Classe Connection, permet de se connecter à la base de données et d'effectuer les requêtes necessaires aux différentes fonctionnalités
 */
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
    

    // Les méthodes Utilisateurs
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
        $stmt = $pdo->getPDO()->prepare('UPDATE UTILISATEURS SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE email = :email');
        $stmt->bindParam(':nom', $user->getNom());
        $stmt->bindParam(':prenom', $user->getPrenom());
        $stmt->bindParam(':date_naissance', date_format($user->getDateNaissance(), 'Y-m-d'));
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->execute();
    }



    // Les méthodes Albums

    public static function insertAlbum(array $album)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO ALBUMS (title, release_date, img, id_art) VALUES (:title, :release_date, :img, :id_art)');
        $stmt->bindParam(':title', $album['title']);
        $stmt->bindParam(':release_date', $album['release_date']);
        $img_path = $album['img'];
        $stmt->bindParam(':img', $img_path);
        $stmt->bindParam(':id_art', $album['id_art']);
        $stmt->execute();
        $id = $pdo->getPDO()->lastInsertId();
        foreach ($album['genres'] as $genre) {
            $stmt = $pdo->getPDO()->prepare('INSERT INTO A_GENRE (id_album, libelle_genre) VALUES (:id_album, :libelle_genre)');
            $stmt->bindParam(':id_album', $id);
            $stmt->bindParam(':libelle_genre', $genre);
            $stmt->execute();
        }
    }

    public static function updateAlbum($album)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('UPDATE ALBUMS SET title = :title, release_date = :release_date, img = :img, id_art = :id_art WHERE id_album = :id_album');
        $stmt->bindParam(':title', $album->getTitle());
        $stmt->bindParam(':release_date', date_format($album->getReleaseDate(), 'Y-m-d'));
        $img_path = "./images/" . $album->getImg();
        $stmt->bindParam(':img', $img_path);
        $stmt->bindParam(':id_art', $album->getArtiste()->getId());
        $stmt->bindParam(':id_album', $album->getId());
        $stmt->execute();
    }

    public static function supAlbum($id)
    {
        Connection::supAGenre($id);
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM ALBUMS WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id);
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

    public static function getAllGenresAlbum($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM A_GENRE WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id);
        $stmt->execute();
        $genres = $stmt->fetchAll();
        return $genres;
    }








    // Les méthodes Artistes

    public static function getArtiste($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ARTISTES WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
        $artiste = $stmt->fetch();
        return $artiste;
    }

    public static function getArtistesSuivi(Utilisateur $user)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM SUIT WHERE email = :email');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->execute();
        $artistes = $stmt->fetchAll();
        return $artistes;
    }

    public static function insertArtisteSuivi(Utilisateur $user, $id_art)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO SUIT (email, id_art) VALUES (:email, :id_art)');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':id_art', $id_art);
        $stmt->execute();
    }

    public static function supArtisteSuivi(Utilisateur $user, $id_art)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM SUIT WHERE email = :email AND id_art = :id_art');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':id_art', $id_art);
        $stmt->execute();
    }

    public static function getArtistes()
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ARTISTES');
        $stmt->execute();
        $artistes = $stmt->fetchAll();
        return $artistes;
    }

    public static function supArtiste($id)
    {
        Connection::supAlbumsArtiste($id);
        Connection::supSuit($id);
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM ARTISTES WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
    }

    public static function supAlbumsArtiste($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM ALBUMS WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
    }

    public static function updateArtiste($artiste)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('UPDATE ARTISTES SET nom_de_scene = :nom_de_scene, nom = :nom, prenom = :prenom WHERE id_art = :id_art');
        $stmt->bindParam(':nom_de_scene', $artiste->getNomDeScene());
        $stmt->bindParam(':nom', $artiste->getNom());
        $stmt->bindParam(':prenom', $artiste->getPrenom());
        $stmt->bindParam(':id_art', $artiste->getId());
        $stmt->execute();
    }

    public static function insertArtiste(array $artiste)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO ARTISTES (nom_de_scene, nom, prenom) VALUES (:nom_de_scene, :nom, :prenom)');
        $stmt->bindParam(':nom_de_scene', $artiste['nomDeScene']);
        $stmt->bindParam(':nom', $artiste['nom']);
        $stmt->bindParam(':prenom', $artiste['prenom']);
        $stmt->execute();
    }

    public static function getAlbumsArtiste($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ALBUMS WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }

    public static function isArtisteSuivi(Utilisateur $user, $id_art)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM SUIT WHERE email = :email AND id_art = :id_art');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':id_art', $id_art);
        $stmt->execute();
        $artiste = $stmt->fetch();
        return $artiste;
    }
    
    public static function supSuit($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM SUIT WHERE id_art = :id_art');
        $stmt->bindParam(':id_art', $id);
        $stmt->execute();
    }









    // Les méthodes Playlist    

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

    public static function supPlaylist($id)
    {
        Connection::supAllAlbumsInPlaylist($id);
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM PLAYLIST WHERE id_playlist = :id_playlist');
        $stmt->bindParam(':id_playlist', $id);
        $stmt->execute();
    }

    public static function getAlbumInPlaylist($id_playlist, $id_album)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM EST_DANS WHERE id_playlist = :id_playlist AND id_album = :id_album');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->bindParam(':id_album', $id_album);
        $stmt->execute();
        $album = $stmt->fetch();
        return $album;
    }

    public static function insertAlbumInPlaylist($id_playlist, $id_album)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO EST_DANS (id_playlist, id_album) VALUES (:id_playlist, :id_album)');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->bindParam(':id_album', $id_album);
        $stmt->execute();
    }

    public static function supAlbumInPlaylist($id_playlist, $id_album)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM EST_DANS WHERE id_playlist = :id_playlist AND id_album = :id_album');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->bindParam(':id_album', $id_album);
        $stmt->execute();
    }

    public static function supAllAlbumsInPlaylist($id_playlist)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM EST_DANS WHERE id_playlist = :id_playlist');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    }

    public static function getPlaylist($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM PLAYLIST WHERE id_playlist = :id_playlist');
        $stmt->bindParam(':id_playlist', $id);
        $stmt->execute();
        $playlist = $stmt->fetch();
        return $playlist;
    }




    // Les méthodes Genres

    public static function getAllGenres()
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM GENRE');
        $stmt->execute();
        $genres = $stmt->fetchAll();
        return $genres;
    }

    public static function supAGenre($id)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('DELETE FROM A_GENRE WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id);
        $stmt->execute();
    }








    // Les méthodes Recherche

    public static function getAlbumsFromGenre($genre)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM A_GENRE NATURAL JOIN ALBUMS WHERE libelle_genre = :libelle_genre');
        $stmt->bindParam(':libelle_genre', $genre);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }

    public static function getAlbumsFromYear($year)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ALBUMS WHERE strftime("%Y", release_date) = :release_date');
        $stmt->bindParam(':release_date', $year);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }

    public static function getAnnees()
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT DISTINCT strftime("%Y", release_date) as year FROM ALBUMS');
        $stmt->execute();
        $annees = $stmt->fetchAll();
        return $annees;
    }

    public static function searchAlbums($recherche, $genre, $artiste, $annee)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM ALBUMS NATURAL JOIN A_GENRE WHERE title LIKE :recherche AND id_art LIKE :artiste AND strftime("%Y", release_date) = :release_date AND libelle_genre = :libelle_genre');
        $stmt->bindParam(':recherche', '%' . $recherche . '%');
        $stmt->bindParam(':libelle_genre', $genre);
        $stmt->bindParam(':artiste', $artiste);
        $stmt->bindParam(':release_date', $annee);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        return $albums;
    }




    // Les méthodes Notes

    public static function getNoteAlbum($id_album, $email)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM NOTES WHERE id_album = :id_album AND email = :email');
        $stmt->bindParam(':id_album', $id_album);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $note = $stmt->fetch();
        return $note;
    }

    public static function insertNoteAlbum($id_album, $email, $note)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO NOTES (id_album, email, note) VALUES (:id_album, :email, :note)');
        $stmt->bindParam(':id_album', $id_album);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':note', $note);
        $stmt->execute();
    }
}