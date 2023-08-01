<?php
    // ...
    // Add the database connection code (similar to what you have in `bibliotheque.php`)
     //etape 1: preparer les parametres de connection a la base de donnee
     $bd_host = "localhost";
     $bd_name = "bibliotheque";
     $bd_user = "root";
     $bd_password = "";
 
     //etape 2: creer la connextion avec notre base de donnee
     try
     {
         $db = new PDO("mysql:host=$bd_host;dbname=$bd_name;charset=utf8", $bd_user, $bd_password);
     }
     catch (Exception $e)
     {
             die('Erreur : ' . $e->getMessage());
     }

    // Check if the book ID is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["update"])) {
                // Retrieve the updated form data
                $updatedTitre = $_POST["titre"];
                $updatedAuteur = $_POST["auteur"];
                $updatedResume = $_POST["resume"];
                $updatedCategorie = $_POST["categorie"];
    
                // Perform validation on the form data (similar to the "Add" form)
    
                // Construct the UPDATE query to update the book details
                $ordre_sql5 = "UPDATE livre SET titre='$updatedTitre', auteur='$updatedAuteur', resume='$updatedResume', categorie='$updatedCategorie' WHERE id=$id";
    
                // Execute the UPDATE query
                if ($db->query($ordre_sql5)) {
                    // Redirect to the main page (index.php) after successful update
                    header("Location: index.php");
                    exit();
                } else {
                    // Handle the error if the UPDATE query fails
                    die('Error updating the book details.');
                }
            }
        }
    
        
        // Fetch the book details from the database based on the provided ID
        $ordre_sql4 = "SELECT * FROM livre WHERE id LIKE $id";
        $result = $db->query($ordre_sql4);
        
        if ($result) {
            $livre = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            // Handle error if book with the given ID is not found
            die('Book not found.');
        }

        // Handle form submission for updating the book details
    


    } else {
        // Handle error if the ID is not provided or not valid
        die('Invalid book ID.');
    }


    
    // ...
    // Add the rest of your HTML code for the form to edit the book's details
?>

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

    <div class="col-6 mx-auto mb-3">
      <form action="edit.php" method="post">
        <input class="form-control mb-3" type="text" name="titre" placeholder="Titre" value="<?= $livre['titre'] ?>">
        <input class="form-control mb-3" type="text" name="auteur" placeholder="Auteur" value="<?= $livre['auteur'] ?>">
        <textarea class="form-control mb-3" name="resume"  cols="30" rows="10" placeholder="Résume" ><?= $livre['resume'] ?></textarea>
        <select class="form-select  mb-3" name="categorie">
          <option>Choir catégorie</option>
          <option value="Fiction">Fiction</option>
          <option value="Drame">Drame</option>
          <option value="Bande dessinée">Bande dessinée</option>
        </select>
        <input class="form-control mb-3" type="file" name="file">
      

        <div>
          <input type="submit" name="update" class="btn btn-primary" valur="Ajouter" />
          <input type="reset" class="btn btn-secondary" valur="Annuler" />
        </div>
      </form>
    </div>
</body>
</html>
