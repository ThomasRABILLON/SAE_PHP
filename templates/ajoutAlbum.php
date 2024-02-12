<?php

$title = "Ajout d'un album";
ob_start();



$content = ob_get_clean();


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $categories = $_POST["categories"];
    
    // Traitement de l'image
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
        echo "L'image est valide et a été téléchargée avec succès.\n";
    } else {
        echo "Une erreur s'est produite lors du téléchargement de votre image.\n";
    }

    // Stockage des données dans un fichier texte
    $data = "Titre: $titre\nCatégories: $categories\nImage: $uploadFile\n\n";
    $file = fopen("albums.txt", "a");
    fwrite($file, $data);
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <form action="traitement.php" method="post" enctype="multipart/form-data">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un album</title>
    <link rel="stylesheet" href="./static/ajoutAlbum.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un album</h1>
        <form action="traitement.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group" id="categories-container">
                <label>Genres :</label>
                <div id="selected-genres">
                    <!-- Les genres sélectionnés seront affichés ici -->
                </div>
                <button class="boutongenre" type="button" onclick="addGenre()">+</button>
            </div>
            <button class="ajouter">Ajouter</button>
        </form>
    </div>
    <script>
        function addGenre() {
            var select = document.createElement("select");
            select.name = "categories[]";
            select.required = true;
            select.innerHTML = `
                <option value="rock">Rock</option>
                <option value="pop">Pop</option>
                <option value="rap">Rap</option>
                <option value="jazz">Jazz</option>
                <option value="classique">Classique</option>
            `;
            
            var container = document.getElementById("categories-container");
            container.appendChild(select);
        }
    </script>
</body>
</html>
