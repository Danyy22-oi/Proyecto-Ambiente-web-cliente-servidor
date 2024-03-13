<?php
include_once "../../include/functions/autenticado.php";

verificarAutenticacion();

include_once "../../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = recogePost("descripcion");
    /*Sanitizado */
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_SPECIAL_CHARS);
    $errores = [];

    if (empty($descripcion)) {
        $errores[] = "Nombre vacio";
    }

    if (empty($errores)) {
        include '../../DAL/categoriaCrud.php';
        if (agregarCategororia($descripcion)) {
            header("Location: /admin/categorias.php?ingreso=3");
        }
    }
}

include "../../include/templates/header.php";
?>


<main>
    <div class="container">
        <h2>
            Nueva Categoría
        </h2>
        <?php
        foreach ($errores as $error) {
            echo "<li class='error'>$error</li>";
        }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="descripcion">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary color-boton mt-3 mb-3">Añadir Categoría</button>
            </div>
        </form>
    </div>
</main>
<?php

include "../../include/templates/footer.php";
?>