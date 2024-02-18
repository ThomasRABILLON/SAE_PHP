<?php

namespace App\Models\Classe;


/**
 * Classe Genre, permet de créer des objets genre
 */
class Genre
{
    private $libelle;

    public function __construct($libelle)
    {
        $this->libelle = $libelle;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }
}