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
      <button onclick="window.location.href='/insert'">Depuis Yaml</button>
      <form action="" method="post" enctype="multipart/form-data">
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
                <form action="/updateAlbum" method="get" id="<?= $album->getId() ?>">
                  <tr>
                      <td class="text-center pe-3"><?= $album->getId() ?></td>
                      <td class="text-center pe-3"><input type="text" name="" id="update<?= $album->getId() ?>T" value="<?= $album->getTitle() ?>" style="color: white;" disabled></td>
                      <td class="text-center pe-3"><input type="date" name="" id="update<?= $album->getId() ?>RD" value="<?= $album->getReleaseDate() ?>" style="color: white;" disabled></td>
                      <td class="text-center pe-3">
                          <?php 
                              $rend = '| ';
                              foreach ($album->getGenres() as $genre) {
                                  $rend .= $genre->getLibelle() . ' | ';
                              }
                              echo $rend;
                          ?>
                      </td>
                      <td class="text-center"><input type="text" name="" id="update<?= $album->getId() ?>NdS" value="<?= $album->getArtiste()->getNomDeScene() ?>" style="color: white;" disabled></td>
                      <td class="text-center">
                        <div class="button-group">
                          <button type="button" class="btn btn-primary" onclick="modifAlbum(<?= $album->getId() ?>)">Modifer</button>
                          <button type="button" class="btn btn-danger" onclick="window.location.href='/admin/supAlbum?id=<?= $album->getId() ?>'">Supprimer</button>
                        </div>
                      </td>
                  </tr>
                </form>
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
              <form action="/updateAlbum" method="get" id="<?= $artiste->getId() ?>">
              <input type="hidden" name="id" value="<?= $artiste->getId() ?>">
                <tr>
                  <td class="text-center pe-5"><?= $artiste->getId() ?></td>
                  <td class="text-center pe-5"><input type="text" name="" id="update<?= $artiste->getId() ?>NS" value="<?= $artiste->getNomDeScene() ?>" style="color: white;" disabled></td>
                  <td class="text-center pe-5"><input type="text" name="" id="update<?= $artiste->getId() ?>N" value="<?= $artiste->getNom() ?>" style="color: white;" disabled></td>
                  <td class="text-center pe-5"><input type="text" name="" id="update<?= $artiste->getId() ?>P" value="<?= $artiste->getPrenom() ?>" style="color: white;" disabled></td>
                  <td class="text-center">
                    <div class="button-group">
                      <button type="button" class="btn btn-primary" onclick="modifArtiste(<?= $artiste->getId() ?>)">Modifer</button>
                      <button type="button" class="btn btn-danger" onclick="window.location.href='/admin/supArtiste?id=<?= $artiste->getId() ?>'">Supprimer</button>
                    </div>
                  </td>
                </tr>
              </form>
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

  function modifArtiste(id) {
    var NS = document.getElementById("update" + id + "NS");
    var N = document.getElementById("update" + id + "N");
    var P = document.getElementById("update" + id + "P");
    if (NS.disabled) {
      NS.disabled = false;
      N.disabled = false;
      P.disabled = false;
      NS.style.color = "black";
      N.style.color = "black";
      P.style.color = "black";
    } else {
      NS.disabled = true;
      N.disabled = true;
      P.disabled = true;
      NS.style.color = "white";
      N.style.color = "white";
      P.style.color = "white";
      var form = document.getElementById(id);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "nomDeScene";
      input.value = NS.value;
      form.appendChild(input);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "nom";
      input.value = N.value;
      form.appendChild(input);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "prenom";
      input.value = P.value;
      form.appendChild(input);
      form.submit();
    }
  }

  function modifAlbum(id) {
    var T = document.getElementById("update" + id + "T");
    var RD = document.getElementById("update" + id + "RD");
    var NdS = document.getElementById("update" + id + "NdS");
    if (T.disabled) {
      T.disabled = false;
      RD.disabled = false;
      NdS.disabled = false;
      T.style.color = "black";
      RD.style.color = "black";
      NdS.style.color = "black";
    } else {
      T.disabled = true;
      RD.disabled = true;
      NdS.disabled = true;
      T.style.color = "white";
      RD.style.color = "white";
      NdS.style.color = "white";
      var form = document.getElementById(id);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "titre";
      input.value = T.value;
      form.appendChild(input);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "releaseDate";
      input.value = RD.value;
      form.appendChild(input);
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "nomDeScene";
      input.value = NdS.value;
      form.appendChild(input);
      form.submit();
    }
  }
</script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>