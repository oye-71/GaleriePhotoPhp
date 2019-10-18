<div class="row">
    <div class="col d-flex justify-content-center">
        <h3>Images enregistrées sur la galerie :</h3>
    </div>
</div>
<p>
    <?php
    $picturesNumber = 0;
    foreach (glob("../src/img/*.*") as $file) {
        $picturesNumber++;
    }
    echo "Il y a " . $picturesNumber . " images dans la galerie.<br>";

    unset($_POST);
    ?>
</p>
<div class="container">
    <br>
    <?php
    foreach (glob("../src/img/*.*") as $file) {
        echo '<a href="Accueil.php?nom=' . $file . '">';
        echo '<img src="' . $file . '" style="width: 16%; border: 1px solid blue;">';
        echo '</a>';
    }
    ?>
</div>