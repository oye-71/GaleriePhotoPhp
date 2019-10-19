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
            <div class="col d-flex mt-3 justify-content-center">
                <h1 class='center'>Convertisseur / Galerie d'images</h1>
            </div>
        </div>
        <?php
        $pageIsRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if (isset($_GET["btnActiveForm"])) {
            if ($_GET["btnActiveForm"] == 'Importer une image') {
                require 'import_form.php';
            } else {
                echo "<form method='get'>";
                echo "<input class='btn btn-dark mt-1' type='submit' value='Importer une image' name='btnActiveForm'>";
                echo "</form>";
            }
        } else {
            echo "<form method='get'>";
            echo "<input class='btn btn-dark mt-1' type='submit' value='Importer une image' name='btnActiveForm'>";
            echo "</form>";
        }
        if (isset($_POST) && !$pageIsRefreshed) {
            require 'import_method.php';
        }
        ?>
        <br>
        <?php
        require 'galerie.php';
        ?>
    </div>
</body>