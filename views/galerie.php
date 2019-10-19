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
    <div class="row">
        <br>
        <?php
        $i = 0;
        foreach (glob("../src/img/*.*") as $file) {
            if($i == 4){
                echo "</div><div class='row'>";
                $i = 0;
            }
            echo "<div class='col-3 p-2'>";
            echo '<a class="align-middle" href="Accueil.php?nom=' . $file . '">';
            echo '<img class="align-middle img-thumbnail" src="' . $file . '" style="width: 100%;">';
            echo '</a></div>';
            $i++;
        }
        ?>
    </div>
</div>