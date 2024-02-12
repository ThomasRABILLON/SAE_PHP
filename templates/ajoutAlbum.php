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
            <div class="form-group">
                <label for="categories">Genre :</label>
                <select id="categories" name="categories" required>
                    <option value="rock">Rock</option>
                    <option value="pop">Pop</option>
                    <option value="rap">Rap</option>
                    <option value="jazz">Jazz</option>
                    <option value="classique">c</option>
                </select>
                <p> </p>
                <button class="ajouter">Ajouter</button>
            </div>
            
        </form>
    </div>
</body>
</html>
