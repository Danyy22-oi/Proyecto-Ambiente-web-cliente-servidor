<?php

require_once "DAL/SubCategoriaCrud.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $id_producto = $_POST['id_producto'];

    if (agregarSubCategoria($nombre, $id_producto)) {
        echo "<div class='alert alert-success' role='alert'>Subcategoria agregada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar la subcategoria.</div>";
    }
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Nueva Subcategoria</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="id_producto">ID Producto</label>
                <input type="text" class="form-control" id="id_producto" name="id_producto" maxlength="255">
            </div>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Añadir Subcategoria</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>
