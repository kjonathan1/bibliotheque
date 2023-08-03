<?php
    // ...
    // Add the database connection code (similar to what you have in `bibliotheque.php`)
     //etape 1: preparer les parametres de connection a la base de donnee
     $bd_host = "localhost";
     $bd_name = "bibliotheque";
     $bd_user = "root";
     $bd_password = "";

     function upload_file() {
        $file_name = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_type = $_FILES["file"]["type"];
        $file_size = $_FILES["file"]["size"];
        $file_error = $_FILES["file"]["error"];
    
        // Generate a timestamp to append to the filename
        $timestamp = time(); // You can customize the timestamp format if needed
    
        // Extract the file extension from the original filename
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    
        // Create a new filename with the timestamp and original extension
        $new_filename = $timestamp . '_' . $file_name;
    
        // Define the destination path
        $destination = "uploads/" . $new_filename;  // Choose your upload directory
    
        // Handle the uploaded file
        if ($file_error === UPLOAD_ERR_OK) {
            move_uploaded_file($file_tmp, $destination);
            return $new_filename;
        } else {
            echo "File upload error: " . $file_error;
        }
        
    }
 
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
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

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
    }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            if (isset($_POST["update"])) {
                // Retrieve the updated form data
                $id = $_POST['id'];
                $updatedTitre = $_POST["titre"];
                $updatedAuteur = $_POST["auteur"];
                $updatedResume = $_POST["resume"];
                $updatedCategorie = $_POST["categorie"];
                $updatedFile = upload_file();

                // Perform validation on the form data (similar to the "Add" form)

                // Construct the UPDATE query to update the book details
                $ordre_sql5 = "UPDATE livre SET titre=?, auteur=?, resume=?, categorie=?, fichier=? WHERE id=?";
                $statement = $db->prepare($ordre_sql5);
                
                
                // Execute the UPDATE query
                if ($statement) {
                    // bind parameters
                    $statement->bindParam(1, $updatedTitre);
                    $statement->bindParam(2, $updatedAuteur);
                    $statement->bindParam(3, $updatedResume);
                    $statement->bindParam(4, $updatedCategorie);
                    $statement->bindParam(5, $updatedFile);
                    $statement->bindParam(6, $id);

                    //Execute the statement
                    if ($statement->execute()) {
                        echo "Record updated successfully.";
                        // Redirect to the main page (index.php) after successful update
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Error updating record: " . $statement->errorInfo()[2];
                    }

                    $statement->close();
                } else {
                    // Handle the error if the UPDATE query fails
                    echo "Error in preparing statement: " . $pdo->errorInfo()[2];
                }

                $bd->close();
            }
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
      <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="text" hidden name="id" value="<?= $livre['id'] ?>">
        <input class="form-control mb-3" type="text" name="titre" placeholder="Titre" value="<?= $livre['titre'] ?>">
        <input class="form-control mb-3" type="text" name="auteur" placeholder="Auteur" value="<?= $livre['auteur'] ?>">
        <textarea class="form-control mb-3" name="resume"  cols="30" rows="10" placeholder="Résume" ><?= $livre['resume'] ?></textarea>
        <select class="form-select  mb-3" name="categorie">
          <option>Choir catégorie</option>
          <option value="Fiction">Aventure</option>
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