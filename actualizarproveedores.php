<?php

require_once "DAL/proveedoresCrud.php";

$proveedores = getArray("SELECT * FROM proveedores");
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once "include/functions/recoge.php";
    $id = recogeGet("id");

    $query = "SELECT Id_Proveedor, Nombre, Logo FROM proveedores WHERE Id_Proveedor = '$id'";
    $mySession = getObject($query);

    if ($mySession != null) {
        $id = $mySession['Id_Proveedor'];
        $nombre = $mySession['Nombre'];
        $logo = $mySession['Logo'];
    } else {
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "include/functions/recoge.php";
    $id = recogePost("Id_Proveedor");
    $nombre = recogePost("nombre");
    $logo = recogePost("logo");

    if (empty($nombre)) {
        $errores['nombre'] = "Por favor ingrese el nombre del proveedor.";
    } else {
        if (EditarProveedores($id, $nombre, $logo)) {
            header("Location: admin/proveedores.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al agregar el proveedor.</div>";
        }
    }
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Editar Proveedor</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="Id_Proveedor" value="<?= $id ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" maxlength="255" value="<?= $nombre ?>">
            </div>
            <div class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></div>
            <br>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="imagen" name="logo">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Proveedor</button>
            </div>
        </form>
    </div>
</main>
<script>
    function subirImagen(event) {

        var formData = new FormData();
        var file = document.getElementById('imagen').files[0];
        formData.append('imagen', file);

        $.ajax({
            url: 'subirImagenProovedor.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $('form').on('submit', subirImagen);
</script>
<?php
include_once 'include/templates/footer.php';
?>

</html>