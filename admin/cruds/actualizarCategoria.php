<?php

include_once "../../include/functions/autenticado.php";

verificarAutenticacion();
include_once "../../include/functions/recoge.php";


$errores = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = recogeGET("id");
    require_once "../../DAL/categoriaCrud.php";
    $query = "SELECT *FROM categorias WHERE Id_Categoria = $id";
    $categoria = getArray($query);
    $descripcion = $categoria[0]['Descripcion'];

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = recogePost("descripcion");
    $idCategoria = recogePost("id");

    /*Sanitizado */
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_SPECIAL_CHARS);

    
    if (empty($descripcion)) {
        $errores[] = "Nombre vacio";
    }

    if (empty($errores)) {
        include '../../DAL/categoriaCrud.php';
        if (actualizarCategoria($idCategoria,$descripcion)) {
            header("Location: /admin/categorias.php?ingreso=1");
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
        <input type="text" name="id" value="<?php  echo $id ?>" hidden>
            <div class="form-group">
                <label for="descripcion">Nombre de la Categoría<span class="required">*</span></label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255" value="<?php echo $descripcion?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary color-boton mt-3 mb-3">Actualizar Categoria</button>
            </div>
        </form>
    </div>
</main>
<?php

include "../../include/templates/footer.php";
?>