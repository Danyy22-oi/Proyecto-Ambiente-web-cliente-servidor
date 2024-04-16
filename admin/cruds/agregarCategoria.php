<?php

include_once "../../include/functions/autenticado.php";

$auth = estaAutenticado();
if(!$auth){
    header('Location: /');
}

$authAdmin = estaAutenticadoAdmin();
if(!$authAdmin){
    header('Location: /');
}


include_once "../../include/functions/recoge.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = recogePost("descripcion");
    /* Sanitizado */
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($descripcion)) {
        $errores[] = "Por favor ingrese el nombre de la categoría";
    }

    if (empty($errores)) {
        include_once '../../DAL/categoriaCrud.php';
        if (agregarCategororia($descripcion)) {
            header("Location: /admin/categorias.php?ingreso=3");
        } else {
            $errores[] = "Error al agregar la categoría";
        }
    }
}

include "../../include/templates/header.php";
?>

<main>
    <div class="container">
        <h2>Nueva Categoría</h2>
        <form method="POST">
            <div class="form-group">
                <label for="descripcion">Nombre de la Categoría<span class="required">*</span></label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255">
            </div>
            <?php foreach ($errores as $error) : ?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php endforeach; ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary color-boton mt-3 mb-3">Añadir Categoría</button>
            </div>
        </form>
    </div>
</main>

<?php
include "../../include/templates/footer.php";
?>