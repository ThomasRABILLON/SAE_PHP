<?php

namespace App\Models\Albums;

class Album implements IRender{
    
        private $entryId;
        private $by;
        private $title;
        private $releaseYear;
        private $genre;
        private $parent;
        private $img;
    
        public function __construct($entryId, $by, $title, $releaseYear, $genre, $parent, $img)
        {
            $this->entryId = $entryId;
            $this->by = $by;
            $this->title = $title;
            $this->releaseYear = $releaseYear;
            $this->genre = $genre;
            $this->parent = $parent;
            $this->img = $img;
        }
    
        /**
        * Permet de récupérer l'id de l'album
        */ 
        public function getEntryId()
        {
            return $this->entryId;
        }

        /**
        * Permet de récupérer l'auteur de l'album
        */ 
        public function getBy()
        {
            return $this->by;
        }
    
        /**
        * Permet de récupérer le titre de l'album
        */
        public function getTitle()
        {
            return $this->title;
        }
        
        /**
        * Permet de récupérer l'année de sortie de l'album
        */ 
        public function getReleaseYear()
        {
            return $this->releaseYear;
        }
        
        /**
        * Permet de récupérer les genres de l'album
        */ 
        public function getGenre()
        {
            return $this->genre;
        }

        /**
         * Permet de récupérer la personne qui a écrit l'album
         */
        public function getParent()
        {
            return $this->parent;
        }

        /**
         * Permet de récupérer l'image de l'album
         */
        public function getImg()
        {
            return $this->img;
        }

        public function render()
        {
            $rend = "<div class=\"container-sm mb-5\">
            <p>{$this->entryId}</p>
            <a class=\"link-opacity-50-hover\" href=\"/test.php?interprete={$this->by}\">
            <h1 class=\"fs-1\">{$this->by}</h1>
            </a>
            <h2 class=\"fs-2\">{$this->title}</h2>
            <p class=\"fs-5\">Sortie en : {$this->releaseYear}</p>
            <span class=\"fs-5\">Genre : <div class=\"list-group\">";
            foreach ($this->genre as $genre) {
                $rend .= "<a href=\"#\" class=\"list-group-item list-group-item-action fs-6\">{$genre}</a>";
            }
            $rend .= "
            </div>
            </span>
            <p class=\"fs-5\">Ecrit par : {$this->parent}</p>
            <img src=\"/fixtures/fixtures/images/{$this->img}\" alt=\"img-album\">
            </div>
            ";
            return $rend;
        }
}