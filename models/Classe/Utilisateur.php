<?php

namespace App\Models\Classe;


/**
 * Classe Utilisateur, permet de représenter un utilisateur
 */
class Utilisateur
{
    private $email;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $mdp;

    public function __construct($email, $nom, $prenom, $dateNaissance, $mdp)
    {
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->mdp = $mdp;
    }

    public function getEmail()
    {
        return $this->email;
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

    public function getMdp()
    {
        return $this->mdp;
    }
}