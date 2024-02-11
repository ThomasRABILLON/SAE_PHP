<?php

namespace App\Models\Database;

use PDO;
use App\Models\Builder;

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
}