
<aside>
    <section>
        <nav>
            <ul>
                <li><a class="lien_aside"  href="/home"> <img class="image_nav" src="../static/image/accueil.png" alt="Home"><p>Home</p></a></li>
                <li><a class="lien_aside"  href="/artiste_suivi"> <img class="image_loupe" src="../static/image/loupe.png" alt="Search"><p>Mes artistes suivis</p></a></li>
                <li><a class="lien_aside"  href="/playlists"> <img class="image_librairie" src="../static/image/librairie.png" alt="Library"><p>Mes playlistes</p></a></li>
                <li><a class="lien_aside"  href="/create_playlist"> <img class="image_add" src="../static/image/add.png" alt="create"><p>Crée une playliste</p></a></li>
            </ul>
        </nav>
    </section>
    <section>
        <h2 class="Titre_aside">Greatest song of 2024</h2>
        <?php foreach ($albums as $album) {
            echo "<li class='white-text'>" . $album->getTitle() . "</li>";
        } ?>
    </section>
</aside>