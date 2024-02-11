<?php
$title = "Création de compte";
$h1 = "Création de compte";
ob_start();
?>

<form action="/register" method="post">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <div class="form-group">
        <label for="dateNaissance">Date de naissance</label>
        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<?php
$content = ob_get_clean();
include 'connectBaseLayout.php';
?>