<?php
$title = "Connexion";
$h1 = "9h4quarts";
ob_start();
?>

<h2 class="soustitreregister">Connexion</h2>
<div class="container">
    <div class="form-container">
        <form action="/login" method="post">
            <div class="form-group">
                <label class="labelRegister" for="email">Email</label>
                <input class="inputRegister" type="email" class="form-control" id="email" name="email" required>
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
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a id="lienregister" href="/register">Créer un compte</a>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'connectBaseLayout.php';
?>