<?php
$title = "Connexion";
$h1 = "Connexion";
ob_start();
?>

<form action="/login" method="post">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" required>
    </div>
    <?php 
    if (isset($error)) {
        echo "<p>" . $error . "</p>";
    }
    ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php
$content = ob_get_clean();
include 'connectBaseLayout.php';
?>