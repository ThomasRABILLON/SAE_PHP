<?php
$title = "9h4quarts - Profil";
ob_start();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profil</h1>
            <p>Bienvenue sur votre profil, <?= $_SESSION['user']->getNom() ?> <?= $_SESSION['user']->getPrenom() ?> !</p>
            <p>Vous pouvez modifier vos informations personnelles ci-dessous :</p>
            <form action="/profil" method="post">
                <div class="form-group row">
                    <label class="labelprofil" for="nom" class="col-sm-2 col-form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $_SESSION['user']->getNom() ?>">
                </div>
                <div class="form-group row">
                    <label class="labelprofil" for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $_SESSION['user']->getPrenom() ?>">
                </div>
                <div class="form-group row">
                    <label class="labelprofil" for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="<?= date_format($_SESSION['user']->getDateNaissance(), 'Y-m-d') ?>">
                </div>
                <button id="modif" type="button" class="btn btn-primary">Modifier</button>
                <a id="lienregister" href="/logout" class="btn btn-danger">Se déconnecter</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('modif').addEventListener('click', function(e) {
        let conf = confirm('Voulez-vous vraiment modifier vos informations ?');
        if (conf) {
            document.querySelector('form').submit();
        }
    });
</script>

<?php
$content = ob_get_clean();
require 'connectBaseLayout.php';
?>