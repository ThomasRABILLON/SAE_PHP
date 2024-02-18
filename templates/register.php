<?php
$title = "9h4quarts - Register";
ob_start();
?>

    <h1 class="titreregister">9h4quarts</h1>
    <h2 class="soustitreregister">Inscription</h2>
    <div class="container">
        <div class="form-container">
            <form action="/register" method="post">
                <div class="form-group">
                    <label class="labelRegister" for="email">Email</label>
                    <input class="inputRegister" type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label class="labelRegister " for="nom">Nom</label>
                    <input class="inputRegister" type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label class="labelRegister" for="prenom">Prénom</label>
                    <input class="inputRegister" type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label class="labelRegister" for="dateNaissance">Date de naissance</label>
                    <input class="inputRegister" type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                </div>
                <div class="form-group">
                    <label class="labelRegister" for="mdp">Mot de passe</label>
                    <input class="inputRegister" type="password" class="form-control" id="mdp" name="mdp" required>
                </div>
                <?php 
                if (isset($error)) {
                    echo "<p>" . $error . "</p>";
                }
                ?>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
    </div>


<?php
$content = ob_get_clean();
include 'connectBaseLayout.php';
?>