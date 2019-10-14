<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Galerie / Convertisseur Image</title>


    </head>
    <body>
        <h1>Bienvenue sur le convertisseur d'images</h1>
		
		<?php
		
		include ('import_file.php');
		
		$filename=$file;
		
		echo '<form method="post" action="Accueil.php">
<select name="taskOption">
      <option value="jpg">JPG</option>
      <option value="jpeg">JPEG</option>
      <option value="png">PNG</option>
	  <option value="gif">GIF</option>
</select>
<input type="submit" value="Submit the form" />
</form>';		
		
function resize_img($file,$max_size = 1280,$qualite = 100,$type = 'auto'){

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

		// On vérifie quel coté est le plus grand
		if($img_width >= $img_height && $type != "height"):

		  // Calcul des nouvelles dimensions à partir de la largeur
		  if($max_size >= $img_width):
			return 'no_need_to_resize';
		  endif;

		  $new_width = $max_size;
		  $reduction = ( ($new_width * 100) / $img_width );
		  $new_height = round(( ($img_height * $reduction )/100 ),0);

		else:

		  // Calcul des nouvelles dimensions à partir de la hauteur
		  if($max_size >= $img_height):
			return 'no_need_to_resize';
		  endif;

		  $new_height = $max_size;
		  $reduction = ( ($new_height * 100) / $img_height );
		  $new_width = round(( ($img_width * $reduction )/100 ),0);

		endif;

		// Création de la ressource pour la nouvelle image
		$dest = imagecreatetruecolor($new_width, $new_height);
		
		// En fonction de l'extension on prépare l'iamge
		switch($extension){
		  case 'jpg':
		  case 'jpeg':
			$src = imagecreatefromjpeg($file); // Pour les jpg et jpeg
		  break;

		  case 'png':
			$src = imagecreatefrompng($file); // Pour les png
		  break;

		  case 'gif':
			$src = imagecreatefromgif($file); // Pour les gif
		  break;
		}

		// Création de l'image redimentionnée
		if(imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)):

		  // On remplace l'image en fonction de l'extension
		  switch($extension){
			case 'jpg':
			case 'jpeg':
			  imagejpeg($dest , $file, $qualite); // Pour les jpg et jpeg
			break;

			case 'png':
			  imagepng($dest , $file, $qualite); // Pour les png
			break;

			case 'gif':
			  imagegif($dest , $file, $qualite); // Pour les gif
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
		
		
    </body>
</html>
