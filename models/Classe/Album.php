<?php

namespace App\Models\Classe;

class Album implements IRender{
    
        private $id_album;
        private $title;
        private $releaseDate;
        private $img;
        private $genres;
        private $artiste;
    
        public function __construct($id_album, $title, $releaseDate, $img, $genres, $artiste)
        {
            $this->id_album = $id_album;
            $this->title = $title;
            $this->releaseDate = $releaseDate;
            $this->img = $img;
            $this->genres = $genres;
            $this->artiste = $artiste;
        }
    
        /**
        * Permet de récupérer l'id de l'album
        */ 
        public function getId()
        {
            return $this->id_album;
        }

        /**
        * Permet de récupérer l'auteur de l'album
        */ 
        public function getArtiste()
        {
            return $this->artiste;
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
        public function getReleaseDate()
        {
            return $this->releaseDate;
        }
        
        /**
        * Permet de récupérer les genres de l'album
        */ 
        public function getGenres()
        {
            return $this->genres;
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
            <p>{$this->id_album}</p>
            <a class=\"link-opacity-50-hover\" href=\"/test.php?interprete={$this->artiste->getNomDeScene()}\">
            <h1 class=\"fs-1\">{$this->artiste->getNomDeScene()}</h1>
            </a>
            <h2 class=\"fs-2\">{$this->title}</h2>
            <p class=\"fs-5\">Sortie en : {$this->releaseDate}</p>
            <span class=\"fs-5\">Genre : <div class=\"list-group\">";
            foreach ($this->genres as $genre) {
                $rend .= "<a href=\"#\" class=\"list-group-item list-group-item-action fs-6\">{$genre->getLabelle()}</a>";
            }
            $rend .= "
            </div>
            </span>
            <img src=\"/fixtures/fixtures/images/{$this->img}\" alt=\"img-album\">
            </div>
            ";
            return $rend;
        }
}