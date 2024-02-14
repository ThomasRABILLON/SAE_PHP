<?php
session_start();
?>
<footer>
    <section class="infos_musique">
        <img src="images/Superdrag-Stereo_360_Sound.jpg" alt="image de l'album en cours de lecture">
        <!--src="<?php //$_SESSION['musiqueActuelle']->getImg() ?>"-->
        <div>
            <p>
                titre de la musique <!--<?php //$_SESSION['musiqueActuelle']->getTitle() ?>-->
            </p>
            <p>
                auteur de la musique <!--<?php //$_SESSION['musiqueActuelle']->getBy() ?>-->
            </p>
        </div>
    </section>
    <section class="deroulement_musique">
        <div>
            <img src="images/previous.png" alt="bouton précédent">
            <?php $play = true; if (!$play){//if ($_SESSION['musiqueActuelle']->getEtat() == "pause") { ?>
                <img src="images/pause.jpg" alt="bouton pause">
            <?php } else { ?>
                <img src="images/play.jpg" alt="bouton play">
            <?php } ?>
            <img src="images/next.png" alt="bouton suivant">
        </div>
        <div class="slidecontainer">
            <p>0:00</p> <!--<?php //$_SESSION['musiqueActuelle']->getDureeActuelle() ?>-->
                <input type="range" min="1" max="100" value="50" class="slider" id="myRange"> <!-- max = tps musique en secondes -->
            <p>3:00</p> <!--<?php //$_SESSION['musiqueActuelle']->getDuree() ?>-->
        </div>
    </section>
    <section class="son">
        <div>
            <img src="images/volume.png" alt="bouton volume">
            <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
        </div>
    </section>
</footer>