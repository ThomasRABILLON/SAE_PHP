<?php
$title = "Detail Album";
ob_start();
session_start();


interface IRender
{
    public function render();
}

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

    /**
     * Renvoie un affichage html simple de l'album
     */
    public function render()
    {
        $rend = '<div class="album-container">';
        $rend .= '<img src="' . $this->getImg() . '" alt="' . $this->getTitle() . '">';
        $rend .= '<h2>' . $this->getTitle() . '</h2>';
        $rend .= '<p>' . $this->getArtiste()->getNomDeScene() . '</p>';
        $rend .= '<button onclick=`window.location.href="/details_album.php"`>Voir plus</button>';
        $rend .= '</div>';
        return $rend;
    }

    /**
     * Renvoie un affichage html détaillé de l'album
     */
    public function displayDetails()
    {
        $rend = '<div class="album-details">';
        $rend .= '<img src="' . $this->getImg() . '" alt="' . $this->getTitle() . '">';
        $rend .= '<h2>' . $this->getTitle() . '</h2>';
        $rend .= '<p>Date de sortie: ' . $this->getReleaseDate() . '</p>';
        $rend .= '<p>Genres: ' . implode(', ', $this->getGenres()) . '</p>';
        $rend .= '<p>Artiste: ' . $this->getArtiste() . '</p>';
        $rend .= '</div>';
        return $rend;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/album_details.css">
    <title>Album Details</title>
</head>

<body>
    <div class="album-details">
        <?php

        $_GET['album'] = new Album(
            1,
            "The Dark Side of the Moon",
            1973,
            "https://upload.wikimedia.org/wikipedia/en/3/3b/Dark_Side_of_the_Moon.png",
            ["rock", "progressive rock"],
            "Pink Floyd"
        );

        $currentAlbum = $_GET['album'];

        // Récupération du nom de l'album depuis l'URL
        $albumId = isset($_GET['album']) ? $_GET['album'] : '';

        // Vérification si l'album existe
        //if (array_key_exists($albumId, $albums)) {
            $currentAlbum = $albums[$albumId];

            // Affichage des informations de l'album
            echo $_GET['album']->displayDetails();
        //} else {
        //    echo '<p>Album non trouvé.</p>';
        //}
        ?>
    </div>
</body>

</html>