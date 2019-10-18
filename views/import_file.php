<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require 'navbar.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <h1 class='center'>Convertisseur / Galerie d'images</h1>
            </div>
        </div>
        <form method='post' enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="border:1px solid blue;">
            <label>Selectionnez une image à importer</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type='file' name='image' id='image'><br>
            <input type='submit' value='Importer' name='btnImport'>
        </form>
        <br>
        <?php

        // répertoire cible des images uploadées
        define('TARGET', '../src/img/');
        // Liste des formats d'image valides
        $tabExt = array('jpg', 'gif', 'png', 'jpeg');

        // On vérifie que le formulaire posté n'est pas vide
        if (!empty($_POST)) {
            // if ($_POST['btnImport'] == 'Importer') {
            echo "Formulaire posté.<br>";

            // On vérifie que l'input censé contenir l'image n'est pas vide
            if (!empty($_FILES['image']['name'])) {
                echo "Image chargée<br>";
                $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                echo "L'extension est : ", $fileExtension, '<br>';

                // On vérifie que l'extension du fichier posté est bien une extension d'image
                if (in_array($fileExtension, $tabExt)) {
                    echo 'Le fichier est bien une image<br>';

                    // On vérifie qu'il n'y ait pas d'erreur dans le fichier 
                    if (isset($_FILES['image']['error']) && UPLOAD_ERR_OK === $_FILES['image']['error']) {
                        echo "Pas d'erreur interne<br>";
                        $imageName = md5(uniqid()) . '.' . $fileExtension;
                        $imageLocation = TARGET . $imageName;

                        // On vérifie que l'import se réalise sans erreur
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $imageLocation)) {
                            echo "Import réussi !<br>";
                        } else {
                            echo "Echec lors de l'import !<br>";
                        }
                    } else {
                        echo  "Une erreur a empêché l'import de l'image.</br>";
                    }
                } else {
                    echo "Erreur : le fichier n'est pas une image<br>";
                }
            } else {
                echo "Pas d'image";
            }
        } //else {
        //echo 'On a pas cliqué sur Importer';
        //}
        /*}*/ else {
            echo "Pas de fichier à importer.";
        }


        echo '<br>';

        $picturesNumber = 0;
        foreach (glob("../src/img/*.*") as $file) {
            $picturesNumber++;
        }
        echo "Il y a " . $picturesNumber . " images dans la galerie.<br>";

        unset($_POST);
        ?>

        <br>

        <tbody>
            <?php
            foreach (glob("../src/img/*.*") as $file) {
                echo '<a href="Accueil.php?nom=' . $file . '">';
                echo '<img src="' . $file . '" style="width: 16%; border: 1px solid blue;">';
                echo '</a>';
            }
            ?>
    </div>
</body>