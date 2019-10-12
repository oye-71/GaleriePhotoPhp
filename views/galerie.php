<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Images enregistrées sur la galerie :</h1>
    <div class="container">
        <?php
        $picturesNumber = 0;
        foreach (glob("../src/img/*.*") as $file) {
            $picturesNumber++;
        }
        echo "Il y a " . $picturesNumber . " images dans la galerie.<br>";
        ?>
        <a href="import_file.php">Importer une image</a>
        <br>
        <?php
        // Affichage des images
        foreach (glob("../src/img/*.*") as $file) {
            echo '<img src="' . $file . '" style="width: 200px; border: 1px solid blue;">';
        }
        ?>
    </div>
</body>