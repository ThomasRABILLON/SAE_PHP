<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <table class="table table-hover">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Titre</th>
                  <th>Date de publication</th>
                  <th>Genres</th>
                  <th>Artistes</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($albums as $album) { ?>
                  <tr>
                      <td><?= $album->getId() ?></td>
                      <td><?= $album->getTitle() ?></td>
                      <td><?= $album->getReleaseDate() ?></td>
                      <td>
                          <?php 
                              $rend = '| ';
                              foreach ($album->getGenres() as $genre) {
                                  $rend .= $genre->getLibelle() . ' | ';
                              }
                              echo $rend;
                          ?>
                      </td>
                      <td><?= $album->getArtiste()->getNomDeScene() ?></td>
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
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom de scène</th>
              <th>Nom</th>
              <th>Prénom</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($artistes as $artiste) { ?>
                <tr>
                  <td><?= $artiste->getId() ?></td>
                  <td><?= $artiste->getNomDeScene() ?></td>
                  <td><?= $artiste->getNom() ?></td>
                  <td><?= $artiste->getPrenom() ?></td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <p>Example line outside of tab box</p>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>