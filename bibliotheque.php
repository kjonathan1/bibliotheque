<?php
    //place prevu pour d'ventuel variables
    $message = "";
    $livres = "";

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
 
    // etape 3: recuperer les livres qui sont dans notre base de donnees pour les afficher
    $ordre_sql1 = "SELECT * FROM livre";
    $livres = $db->query($ordre_sql1);

    //etape 4: Ajouter un livre a partir de notre formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["form1"])){
            $titre = $_POST["titre"];
            $auteur = $_POST["auteur"];
            $resume = $_POST["resume"];
            $categorie = $_POST["categorie"];
            $file = upload_file();


            if(empty($titre) || empty($auteur) || empty($resume) || empty($categorie)){
                $message = "Un des champ du formulaire est vide....";
            } else {
                $ordre_sql2 = "INSERT INTO livre(titre, auteur, resume, categorie, fichier) VALUES (? , ?, ?, ?, ?)";
                $statment = $db->prepare($ordre_sql2);

                if($statment){
                    $statment->bindParam(1, $titre);
                    $statment->bindParam(2, $auteur);
                    $statment->bindParam(3, $resume);
                    $statment->bindParam(4, $categorie);
                    $statment->bindParam(5, $file);

                    // Execute statement
                    if($statment->execute()){
                        header("Location: index.php");
                        exit();
                    } else {
                        print_r("error: ".$statment->error);
                    }

                    $statment->close();
                } else {
                    print_r("error: ".$bd->error);
                }

                $bd->close();
            }
        }
    }

     //etape 5: supprimer un livre de notre bibliothque
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["form2"])){
            $id = $_POST["id"];
           
            $ordre_sql3 = "DELETE FROM livre WHERE id LIKE ?";
            $statement = $db->prepare($ordre_sql3);

            $statement->bindParam(1, $id);

            if($statement){
                if($statement->execute()) {
                    $message = "Livre suprimé avec succès.";
                    header("Location: index.php");
                    exit();
                } else {
                    print_r("Error". $statement->errorInfo()[2]);
                }
    
                $statement->close();
            }
            $bd->close();
        }
    }
/*
    //etape 6: edtiter un livre de notre base de donees
    // Check if the book ID is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        
        // Fetch the book details from the database based on the provided ID
        $ordre_sql4 = "SELECT * FROM livre WHERE id = $id";
        $result = $db->query($ordre_sql4);
        
        if ($result) {
            $livre = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            // Handle error if book with the given ID is not found
            die('Book not found.');
        }
    } else {
        // Handle error if the ID is not provided or not valid
        die('Invalid book ID.');
    }




    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $ordre_sql3 = "";
        $titre = $_POST["titre"];
        $auteur = $_POST["auteur"];
        $resume = $_POST["resume"];
        $categorie = $_POST["categorie"];

        if(empty($titre) || empty($auteur) || empty($resume) || empty($categorie)){
            $message = "Un des champ du formulaire est vide....";
        } else {
            $ordre_sql2 = "INSERT INTO livre('titre', 'auteur', 'resume', 'categorie') VALUES ($titre , $auteur, $resume, $categorie)";
            if($db->query(ordre_sql2) === TRUE) {
                $message = "Livre inseré avec succès.";
            }
        }
    }
   
*/

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
?>