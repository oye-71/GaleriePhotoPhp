<?php

// Liste des formats d'image valides
$tabExt = array('jpg', 'gif', 'png', 'jpeg');
echo '<p>';
// On vérifie que le formulaire posté n'est pas vide
if (!empty($_POST)) {

    // On vérifie que l'input censé contenir l'image n'est pas vide
    if (!empty($_FILES['image']['name'])) {
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // On vérifie que l'extension du fichier posté est bien une extension d'image
        if (in_array($fileExtension, $tabExt)) {
            echo 'Le fichier est bien une image<br>';

            // On vérifie qu'il n'y ait pas d'erreur dans le fichier 
            if (isset($_FILES['image']['error']) && UPLOAD_ERR_OK === $_FILES['image']['error']) {
                $imageName = md5(uniqid()) . '.' . $fileExtension;
                $imageLocation = '../src/img/' . $imageName;

                // On vérifie que l'import se réalise sans erreur
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imageLocation)) {
                    echo "Import réussi !<br>";
                } else {
                    echo "Echec lors de l'import !<br>";
                }
            } else {
                echo  "Une erreur a empêché l'import de l'image. (Image trop grande ?)</br>";
            }
        } else {
            echo "Erreur : le fichier n'est pas une image<br>";
        }
    } else {
        echo "Pas de fichier à importer.<br>";
    }
} else {
    echo "Pas de fichier à importer.<br>";
}


echo '</p><br>';
