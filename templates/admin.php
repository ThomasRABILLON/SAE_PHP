<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./static/admin.css">
    <title>Admin</title>
</head>
<body>
<div class="wrapper">
  <div class="tabs">
    <div class="tab">
      <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
      <label for="tab-1" class="tab-label">Albums</label>
      <div class="tab-content">
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
              <select name="categories[]" required>
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?= $genre->getLibelle() ?>"><?= $genre->getLibelle() ?></option>
                <?php } ?>
              </select>
              <div id="selected-genres">
                  <!-- Les genres sélectionnés seront affichés ici -->
              </div>
              <button class="boutongenre" type="button" onclick="addGenre()">+</button>
          </div>
          <button class="ajouter">Ajouter</button>
      </form>
      <table class="table-dark table-hover">
          <thead>
              <tr>
                  <th class="text-center pe-3">#</th>
                  <th class="text-center pe-3">Titre</th>
                  <th class="text-center pe-3">Date de publication</th>
                  <th class="text-center pe-3">Genres</th>
                  <th class="text-center pe-3">Artistes</th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($albums as $album) { ?>
                  <tr>
                      <td class="text-center pe-3"><?= $album->getId() ?></td>
                      <td class="text-center pe-3"><?= $album->getTitle() ?></td>
                      <td class="text-center pe-3"><?= $album->getReleaseDate() ?></td>
                      <td class="text-center pe-3">
                          <?php 
                              $rend = '| ';
                              foreach ($album->getGenres() as $genre) {
                                  $rend .= $genre->getLibelle() . ' | ';
                              }
                              echo $rend;
                          ?>
                      </td>
                      <td class="text-center"><?= $album->getArtiste()->getNomDeScene() ?></td>
                      <td class="text-center">
                        <div class="button-group">
                          <button type="button" class="btn btn-primary">Modifer</button>
                          <button type="button" class="btn btn-danger">Supprimer</button>
                        </div>
                      </td>
                  </tr>
              <?php } ?>
          </tbody>
      </table>
      </div>
    </div>
    <div class="tab">
      <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
      <label for="tab-2" class="tab-label">Artistes</label>
      <div class="tab-content">
        <table class="table-dark table-hover">
          <thead>
            <tr>
              <th class="text-center pe-5">#</th>
              <th class="text-center pe-5">Nom de scène</th>
              <th class="text-center pe-5">Nom</th>
              <th class="text-center pe-5">Prénom</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($artistes as $artiste) { ?>
                <tr>
                  <td class="text-center pe-5"><?= $artiste->getId() ?></td>
                  <td class="text-center pe-5"><?= $artiste->getNomDeScene() ?></td>
                  <td class="text-center pe-5"><?= $artiste->getNom() ?></td>
                  <td class="text-center pe-5"><?= $artiste->getPrenom() ?></td>
                  <td class="text-center">
                    <div class="button-group">
                      <button type="button" class="btn btn-primary">Modifer</button>
                      <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                  </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  function addGenre() {
    var select = document.createElement("select");
    select.name = "categories[]";
    select.required = true;
    select.innerHTML = `
      <?php foreach ($genres as $genre) { ?>
        <option value="<?= $genre->getLibelle() ?>"><?= $genre->getLibelle() ?></option>
      <?php } ?>
    `;
    
    var container = document.getElementById("categories-container");
    container.appendChild(select);
  }
</script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>