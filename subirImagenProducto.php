<?php
    
    require_once "include/functions/autenticado.php";
    $auth = estaAutenticado();
    if (!$auth) {
        header('Location: /');
    }
    $authADmin = estaAutenticadoAdmin();
    if(!$authADmin){
        header('Location: /');
    }
$ruta = 'img/productos/';
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $file_extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
    if (in_array(strtolower($file_extension), $allowed_extensions)) {
        $file_name = $_FILES["imagen"]["name"];
        $file_tmp = $_FILES["imagen"]["tmp_name"];
        if (move_uploaded_file($file_tmp, $ruta . $file_name)) {
            echo $ruta . $file_name;
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Formato de archivo no válido.";
    }
} else {
    echo "Error al cargar la imagen.";
}
?>