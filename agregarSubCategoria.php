<?php
require_once "DAL/SubCategoriaCrud.php";

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if (empty($nombre)) {
        $errores['nombre'] = "Por favor ingrese el nombre de la subcategoría.";
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = "Por favor ingrese la descripción de la subcategoría.";
    }

    if (empty($errores)) {
        if (agregarSubCategoria($nombre, $descripcion)) {
            echo "<div class='alert alert-success' role='alert'>Subcategoría agregada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al agregar la subcategoría.</div>";
        }
    }
}

include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Nueva Subcategoría</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre<span class="required">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255">
                <div class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción<span class="required">*</span></label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255">
                <div class="text-danger"><?php echo isset($errores['descripcion']) ? $errores['descripcion'] : ''; ?></div>
            </div>
            <div>
                <br>
                <button type="submit" class="btn btn-primary color-boton">Añadir Subcategoría</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>
