<?php

namespace App\Models\Database;

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

    public static function getInstance()
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
            $stmt = $pdo->getPDO()->prepare('INSERT INTO ARTISTES (id_art, nom, prenom, nom_de_scene) VALUES (:id_art, :nom, :prenom, :nom_de_scene)');
            $stmt->bindParam(':id_art', $artiste->getId());
            $stmt->bindParam(':nom', $artiste->getNom());
            $stmt->bindParam(':prenom', $artiste->getPrenom());
            $stmt->bindParam(':nom_de_scene', $artiste->getNomDeScene());
            $stmt->execute();
        }
        foreach ($data['genres'] as $genre) {
            foreach ($genre as $g) {
                $stmt = $pdo->getPDO()->prepare('INSERT INTO GENRES (id_genre, nom) VALUES (:id_genre, :nom)');
                $stmt->bindParam(':id_genre', $g->getId());
                $stmt->bindParam(':nom', $g->getNom());
                $stmt->execute();
            }
        }
        foreach ($data['albums'] as $album) {
            $stmt = $pdo->getPDO()->prepare('INSERT INTO ALBUMS (id_album, title, release_date, img, id_art) VALUES (:id_album, :title, :release_date, :img, :id_artiste)');
            $stmt->bindParam(':id_album', $album->getId());
            $stmt->bindParam(':title', $album->getTitle());
            $stmt->bindParam(':release_date', date_format($album->getReleaseDate(), 'Y-m-d'));
            $stmt->bindParam(':img', $album->getImg());
            $stmt->bindParam(':id_artiste', $album->getArtiste()->getId());
            $stmt->execute();
        }
    }
    
    public static function insertUser($nom, $prenom, $dateNaissance, $mdp)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('INSERT INTO UTILISATEURS (id_user, nom, prenom, date_naissance, mdp) VALUES (1, :nom, :prenom, :date_naissance, :mdp)');
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_naissance', $dateNaissance);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
    }

    public static function getUser($nom, $mdp)
    {
        $pdo = self::getInstance();
        $stmt = $pdo->getPDO()->prepare('SELECT * FROM UTILISATEURS WHERE nom = :nom');
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        $user = $stmt->fetch();
        if (password_verify($mdp, $user['mdp'])) {
            return Builder::createUserFromDatabase($user);
        }
        return false;
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
}