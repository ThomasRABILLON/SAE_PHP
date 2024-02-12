<?php

namespace App\Models\Classe;

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