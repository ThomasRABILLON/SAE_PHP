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

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function setReleaseDate($releaseDate)
        {
            $this->releaseDate = $releaseDate;
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
            $rend = '<div class="album-container" id="album-container">';
            $rend .= '<img src="' . str_replace('%', '%25', $this->getImg()) . '" alt="' . $this->getTitle() . '">';
            $rend .= '<h2>' . $this->getTitle() . '</h2>';
            $rend .= '<p>' . $this->getArtiste()->getNomDeScene() . '</p>';
            $rend .= '<button>Voir plus</button>';
            $rend .= '</div>';
            return $rend;
        }
}