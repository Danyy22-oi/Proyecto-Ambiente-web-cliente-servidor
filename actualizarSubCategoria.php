<?php
include_once 'include/templates/header.php';
require_once "DAL/SubCategoriaCrud.php";

// Verificar si se envió el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_SubCategoria'])) {
    $id_SubCategoria = $_POST['id_SubCategoria'];
    $nombre = $_POST['nombre'];
    $id_producto = $_POST['id_producto'];

    if ( EditarSubCategoria($id_SubCategoria, $nombre, $id_producto)) {
        echo "<div class='alert alert-success' role='alert'>Subcategoría actualizada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar la subcategoría.</div>";
    }
}

// Obtener la subcategoría a actualizar (si se proporciona un ID)
if (isset($_GET['id'])) {
    $id_SubCategoria = $_GET['id'];
    $subcategoria = getObject("SELECT * FROM subcategoria WHERE id_SubCategoria = $id_SubCategoria");
}

?>

<main>
    <div class="container">
        <h2>Actualizar Subcategoría</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id_SubCategoria" value="<?php echo $subcategoria['id_SubCategoria']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255" value="<?php echo isset($subcategoria['nombre']) ? $subcategoria['nombre'] : ''; ?>">

            <br>
            <div class="form-group">
                <label for="id_producto">ID Producto</label>
                <input type="text" class="form-control" id="id_producto" name="id_producto" maxlength="255" value="<?php echo isset($subcategoria['id_producto']) ? $subcategoria['id_producto'] : ''; ?>">

            </div>

            <div class="form-group">
                <label for="id_SubCategoria">ID SubCategoria</label>
                <input type="text" class="form-control" id="id_SubCategoria" name="id_producto" maxlength="255" value="<?php echo isset($subcategoria['id_SubCategoria']) ? $subcategoria['id_SubCategoria'] : ''; ?>">

            </div>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Subcategoría</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>
