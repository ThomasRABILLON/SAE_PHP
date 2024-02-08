
<aside>
    <section>
        <nav>
            <ul>
                <li><a href=""> <img class="image_nav" src="../static/image/accueil.png" alt="Home">Home</a></li>
                <li><a href=""> <img class="image_loupe" src="../static/image/loupe.png" alt="Search"> Search</a></li>
                <li><a href=""> <img class="image_librarie" src="../static/image/librairie.png" alt="Library"> Your Library</a></li>
            </ul>
            <h2>Playlists</h2>
            <ul>
                <li><a href=""> <img class="image_add" src="../static/image/add.png" alt="create">create playlist</a></li>
                <li><a href=""> <img class="image_nav" src="../static/image/" alt="Home">liked songs</a></li>
            </ul>
        </nav>
    </section>
    <section>s
        <h2>
            Greatest song of 2024
        </h2>
        <?php foreach ($albums as $album) {

        echo "<li>". $album->getTitle() ."</li>";
        } ?>
    </section>
</aside>