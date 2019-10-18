<!DOCTYPE html>
<html lang="fr">
    <head>
        <head>
	<meta charset="utf-8">
	<title>Convertisseur Image</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require 'navbar.php';
    ?>
        <h1>Bienvenue sur le convertisseur d'images</h1>
		
		<?php
		
		if(isset($_GET['nom']))
		{
			echo '<img src="' . $_GET["nom"] . '" style="width: 200px; border: 1px solid blue;">';
			$fileentry = $_GET['nom'];
		}
		
		function resize_img($file,$new_height='',$new_width='',$extension_export){

			  // Vérification que le fichier existe
			  if(!file_exists($file)):
				return 'wrong_path';
			  endif;

			  // Extensions et mimes autorisés
			  $extensions = array('jpg','jpeg','png','gif');
			  $mimes = array('image/jpeg','image/gif','image/png');

			  // Récupération de l'extension de l'image
			  $tab_ext = explode('.', $file);
			  $extension  = strtolower($tab_ext[count($tab_ext)-1]);

			  // Récupération des informations de l'image
			  $image_data = getimagesize($file);

			  // Test si l'extension est autorisée
			  if (in_array($extension,$extensions) && in_array($image_data['mime'],$mimes)):
				
				// On stocke les dimensions dans des variables
				$img_width = $image_data[0];
				$img_height = $image_data[1];
				
				if(!$new_height):
					$new_height=$img_height;
				endif;
				
				if(!$new_width):
					$new_width=$img_width;
				endif;
				
				// Création de la ressource pour la nouvelle image
				$dest = imagecreatetruecolor($new_width, $new_height);
				
				// En fonction de l'extension on prépare l'image
				switch($extension){
				  case 'jpg':
				  case 'jpeg':
					$src = imagecreatefromjpeg($file); //Pour les jpg et jpeg
				  break;

				  case 'png':
					$src = imagecreatefrompng($file); //Pour les png
				  break;

				  case 'gif':
					$src = imagecreatefromgif($file); //Pour les gif
				  break;
				}

				// Création de l'image redimentionnée
				if(imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)):
				  // On remplace l'image en fonction de l'extension
				  switch($extension_export){
					case 'jpg':
						$file=substr_replace($file,"jpg",-3);
					  imagejpeg($dest , $file); // Pour les jpg et jpeg
					break;

					case 'png':
						$file=substr_replace($file,"png",-3);
					  imagepng($dest , $file); // Pour les png
					break;

					case 'gif':	
						$file=substr_replace($file,"gif",-3);
					  imagegif($dest , $file); // Pour les gif
					break;
				  }

				  return 'success';
				  
				else:
				  return 'resize_error';
				endif;

			  else:
				return 'no_img';
			  endif;
		}
?>		
		<br>
<br>		
		<form method="post">
		<label>Sélectionnez le format d'export : </label>
		<select name="taskOption">
			  <option value="jpg">JPG</option>
			  <option value="png">PNG</option>
			  <option value="gif">GIF</option>
		</select>		
		<br>
		<h4>Sélectionnez si vous le souhaitez les dimensions à donner à votre image (valeurs en pixels) : </h4>
		<label>Sélectionnez la hauteur souhaitée : </label>
		<input type="number" name="height" max="1280">
		<br>		
		<br>
		<label>Sélectionnez la largeur souhaitée : </label>
		<input type="number" name="width" max="1280">
		<br>
		<br>
		<input type="button" onclick="resize_img_js();" value="Export">
		</form>		
		
    </body>
</html>