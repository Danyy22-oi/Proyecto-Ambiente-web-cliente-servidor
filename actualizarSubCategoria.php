<?php

require_once "DAL/SubCategoriaCrud.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_SubCategoria'])) {
    $id_SubCategoria = $_POST['id_SubCategoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if ( EditarSubCategoria($id_SubCategoria, $nombre, $descripcion)) {
        echo "<div class='alert alert-success' role='alert'>Subcategoría actualizada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar la subcategoría.</div>";
    }
}

if (isset($_GET['id'])) {
    $id_SubCategoria = $_GET['id'];
    $subcategoria = getObject("SELECT * FROM subcategoria WHERE id_SubCategoria = $id_SubCategoria");
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Actualizar Subcategoría</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id_SubCategoria" value="<?php echo $subcategoria['id_SubCategoria']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre<span class="required">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255" value="<?php echo isset($subcategoria['nombre']) ? $subcategoria['nombre'] : ''; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción<span class="required">*</span></label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255" value="<?php echo isset($subcategoria['descripcion']) ? $subcategoria['descripcion'] : ''; ?>">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Subcategoría</button>
            </div>
        </form>
    </div>
</main>


<?php
include_once 'include/templates/footer.php';
?>
