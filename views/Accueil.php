<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Convertisseur Image</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
	<?php
	require 'navbar.php';
	require 'resize_img.php'
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col d-flex mt-3 justify-content-center">
				<h1>Editer une image</h1>
			</div>
		</div>
		<div class='row mr-3'>
			<div class='col-9 mt-3 justify-content-center'>
				<?php
				// On teste si la page a été rafraichie
				$pageIsRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
				// On récupère l'image si elle existe
				if (isset($_GET['nom'])) {
					echo '<img src="' . $_GET["nom"] . '" style="max-width: 100%;">';
					$fileentry = $_GET['nom'];
					if (isset($_POST["btnConvertir"]) && !$pageIsRefreshed) {
						$newImg = resize_img($fileentry, $_POST["height"], $_POST["width"], $_POST["taskOption"]);
						if (strstr(
							$newImg,
							"../src/img/"
						)) {
							header('Location: Accueil.php?nom=' . $newImg);
							exit();
						}
					}
				}
				?>
			</div>
			<div class="col-3">
				<br>
				<!-- Formulaire de modification de l'image -->
				<form method="post">
					<h4>Format de l'image :</h4>
					<div class='row'>
						<label class='col-8'>Sélectionnez le format d'export : </label>
						<select class="form-control col" name="taskOption">
							<option value="jpg">JPG</option>
							<option value="png">PNG</option>
							<option value="gif">GIF</option>
						</select>
					</div>
					<label>
						<?php
						$fileExtension = pathinfo($fileentry, PATHINFO_EXTENSION);
						echo "Format actuel de l'image : " . $fileExtension;
						?>
					</label>
					<br>
					<h4>Taille de l'image (facultatif) :</h4>
					<div class='row '>
						<label class='col-8'>Sélectionnez la hauteur souhaitée : </label>
						<div class='col'>
							<input class="form-control" type="number" name="height" max="1920">
						</div>
					</div>
					<br>
					<div class='row'>
						<label class='col-8'>Sélectionnez la largeur souhaitée : </label>
						<div class='col'>
							<input class="form-control" type="number" name="width" max="1920">
						</div>
					</div>
					<br>
					<input class="btn btn-dark" type="submit" value="Convertir" name="btnConvertir">
				</form>
				<br>

				<!-- Téléchargement de l'image -->
				<div>
					<a class="btn btn-dark" href="<?php
													if (isset($_GET["nom"])) {
														echo $_GET["nom"];
													}
													?>" download="<?php
																	echo substr($fileentry, 11);
																	?>">
						Télécharger
					</a>
				</div>
			</div>
		</div>
</body>

</html>