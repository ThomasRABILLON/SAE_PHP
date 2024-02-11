<?php

namespace App\Models\Classe;

class Utilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $mdp;
    private $follows;

    public function __construct(int $id, $nom, $prenom, $dateNaissance, $follows, $mdp)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->follows = $follows;
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

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function getFollows()
    {
        return $this->follows;
    }

    public function getMdp()
    {
        return $this->mdp;
    }
}