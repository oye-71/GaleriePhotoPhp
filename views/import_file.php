<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Import d'une image sur le site</h1>
    <form method='post' enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="border:1px solid blue;">
        <label>Selectionnez une image à importer</label><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type='file' name='image' id='image'><br>
        <button type='submit'>IMPORTER</button>
    </form>
    <?php
    // répertoire cible des images uploadées
    define('TARGET', '../src/img/');
    // Liste des formats d'image valides
    $tabExt = array('jpg', 'gif', 'png', 'jpeg', 'bmp', 'tiff');

    if (!empty($_POST)) {
        echo "Formulaire posté.<br>";
        if (!empty($_FILES['image']['name'])) {
            echo "Image chargée<br>";
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            echo "L'extension est : ", $fileExtension, '<br>';
            if (in_array($fileExtension, $tabExt)) {
                echo 'Le fichier est bien une image<br>';
                if (isset($_FILES['image']['error']) && UPLOAD_ERR_OK === $_FILES['image']['error']) {
                    echo "Pas d'erreur interne<br>";
                    $imageName = md5(uniqid()) . '.' . $fileExtension;
                    $imageLocation = TARGET . $imageName;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $imageLocation)) {
                        echo "Import réussi !<br>";
                        echo '<img src="', $imageLocation, '">';
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
    } else {
        echo "Erreur, pas de fichier";
    }
    ?>
</body>