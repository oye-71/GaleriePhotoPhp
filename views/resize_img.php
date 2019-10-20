<?php
function resize_img($file, $new_height = '', $new_width = '', $extension_export)
{

    // Vérification que le fichier existe
    if (!file_exists($file)) :
        return 'wrong_path';
    endif;

    // Extensions et mimes autorisés
    $extensions = array('jpg', 'jpeg', 'png', 'gif');
    $mimes = array('image/jpeg', 'image/gif', 'image/png');

    // Récupération de l'extension de l'image
    $tab_ext = explode('.', $file);
    $extension  = strtolower($tab_ext[count($tab_ext) - 1]);

    // Récupération des informations de l'image
    $image_data = getimagesize($file);

    // Test si l'extension est autorisée
    if (in_array($extension, $extensions) && in_array($image_data['mime'], $mimes)) :

        // On stocke les dimensions dans des variables
        $img_width = $image_data[0];
        $img_height = $image_data[1];

        if (!$new_height) :
            $new_height = $img_height;
        endif;

        if (!$new_width) :
            $new_width = $img_width;
        endif;

        // Création de la ressource pour la nouvelle image
        $dest = imagecreatetruecolor($new_width, $new_height);

        // En fonction de l'extension on prépare l'image
        switch ($extension) {
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
        if (imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)) :
            // On remplace l'image en fonction de l'extension
            switch ($extension_export) {
                case 'jpg':
                    $file = "../src/img/" . md5(uniqid()) . '.' . "jpg";
                    imagejpeg($dest, $file); // Pour les jpg et jpeg
                    break;

                case 'png':
                    $file = "../src/img/" . md5(uniqid()) . '.' . "png";
                    imagepng($dest, $file); // Pour les png
                    break;

                case 'gif':
                    $file = "../src/img/" . md5(uniqid()) . '.' . "gif";
                    imagegif($dest, $file); // Pour les gif
                    break;
            }

            // return 'success';
            return $file;
        else :
            return 'resize_error';
        endif;

    else :
        return 'no_img';
    endif;
}
