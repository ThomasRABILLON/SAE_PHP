<?php

namespace App\Models\Classe;

class Genre
{
    private $id;
    private $labelle;

    public function __construct($id, $labelle)
    {
        $this->id = $id;
        $this->nom = $labelle;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabelle()
    {
        return $this->labelle;
    }
}