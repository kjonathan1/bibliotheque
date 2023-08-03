<?php include("bibliotheque.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="container">

    <!-- Header -->
    <header class="p-3 m-3 text-bg-dark">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <h2 class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">Ma Bibliothèque</h2>
  
  
          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form>
  
          <div class="text-end">
              <a href="http://" class="btn btn-success"><i class="bi bi-person-fill-gear"></i>Users</a>
              <button type="button" class="btn btn-outline-light me-2">Login</button>
              <button type="button" class="btn btn-warning">Sign-up</button>
          </div>
        </div>
      </div>
    </header>
    <td><?= $message ?></td>
    <!-- Form -->
    <div class="col-6 mx-auto mb-3">
      <form action="index.php" method="post" enctype="multipart/form-data">
        <input class="form-control mb-3" type="text" name="titre" placeholder="Titre">
        <input class="form-control mb-3" type="text" name="auteur" placeholder="Auteur">
        <textarea class="form-control mb-3" name="resume"  cols="30" rows="10" placeholder="Résume"></textarea>
        <select class="form-select  mb-3" name="categorie">
          <option>Choir catégorie</option>
          <option value="Aventure">Aventure</option>
          <option value="Fiction">Fiction</option>
          <option value="Drame">Drame</option>
          <option value="Bande dessinée">Bande dessinée</option>
        </select>
        <input class="form-control mb-3" type="file" name="file">
      

        <div>
          <input type="submit" name="form1" class="btn btn-primary" valur="Ajouter" />
          <input type="reset" class="btn btn-secondary" valur="Annuler" />
        </div>
      </form>
    </div>

    <!-- List -->
    <div class="mb-3">
      <table class="table bordered">
        <tr>
          <th>Titre</th>
          <th>Auteur</th>
          <th>Resumé</th>
          <th>Catégorie</th>
          <th>Lu</th>
          <th colspan="2">Actions</th>
        </tr>
        <?php foreach($livres as $livre){?>
          <tr>
            <td><?= $livre['titre'] ?><a href="uploads/<?= $livre['fichier'] ?>" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a></td>
            <td><?= $livre['auteur'] ?></td>
            <td><?= $livre['resume'] ?></td>
            <td><?= $livre['categorie'] ?></td>
            <td><input type="checkbox" name="etat"></td>
            <td><a href="edit.php?id=<?= $livre['id'] ?>"><i class="bi bi-pencil-square"></i></a></td>
             <td><!--<a href="#"><i class="bi bi-trash3"></i></a> -->
              <form method="post" action="index.php" >
                <input type="text" name="id" hidden value="<?= $livre['id'] ?>" />
                <input type="submit" value="X" name="form2">
              </form>
            </td>
          </tr>
          
        <?php }?>
        
      </table>
    </div>

    <!-- Footer -->
    <footer class="py-3 my-4 text-bg-dark">
     
      <p class="text-center text-light">&copy; 2023 Company, Inc</p>
    </footer>
    
</body>
</html>