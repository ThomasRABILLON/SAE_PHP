<?php

namespace App\Models\Classe;

class Artiste implements IRender
{
    private $id_art;
    private $nom_de_scene;
    private $nom;
    private $prenom;

    public function __construct($id_art, $nom_de_scene, $nom, $prenom)
    {
        $this->id_art = $id_art;
        $this->nom_de_scene = $nom_de_scene;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**
     * Permet de récupérer l'id de l'artiste
     */
    public function getId()
    {
        return $this->id_art;
    }

    /**
     * Permet de récupérer le nom de scene de l'artiste
     */
    public function getNomDeScene()
    {
        return $this->nom_de_scene;
    }
    
    /**
     * Permet de récupérer le nom de l'artiste
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Permet de récupérer le prenom de l'artiste
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function render()
    {
        return "<div class='artiste'>
                    <img src='" . $this->img . "' alt=''>
                    <h2>" . $this->nom . "</h2>
                </div>";
    }
}