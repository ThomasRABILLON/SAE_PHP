<?php

namespace App\Models\Classe;

class Utilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $mdp;

    public function __construct($id, $nom, $prenom, $dateNaissance, $mdp)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->mdp = $mdp;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function getMdp()
    {
        return $this->mdp;
    }
}