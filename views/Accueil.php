<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Gallerie / Convertisseur Image</title>


    </head>
    <body>
        <h1>Bienvenue sur le convertisseur d'images</h1>
		
		<?php
		$filename="C:\Users\MisterAdri\Desktop\Test_Gallerie.png";
		
        imagejpeg(imagecreatefrompng($filename), "C:\Users\MisterAdri\Desktop\Test_Gallerie.jpg");
		?>
		
		
    </body>
</html>
