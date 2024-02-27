<?php
include_once 'include/templates/header.php';
require_once "DAL/proveedoresCrud.php";

$proveedores = getArray("SELECT * FROM proveedores");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $logo = $_POST['logo'];

    if (AgregarProveedores($nombre, $logo)) {
        echo "<div class='alert alert-success' role='alert'>Proveedor agregado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar el proveedor.</div>";
    }
}
?>

<main>
    <div class="container">
        <h2>Nuevo Proveedor</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="logo">Logo</label>
                <textarea class="form-control" id="logo" name="logo" rows="2" maxlength="255"></textarea>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Añadir Proveedor</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>

</html>