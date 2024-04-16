<?php


require_once "include/functions/autenticado.php";
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}

$authAdmin = estaAutenticadoAdmin();
if (!$authAdmin) {
    header('Location: /');
}


require_once "DAL/proveedoresCrud.php";

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $logo = $_POST['logo'];

    if (empty($nombre)) {
        $errores['nombre'] = "Por favor ingrese el nombre del proveedor.";
    }

    if (empty($errores)) {
        if (AgregarProveedores($nombre, $logo)) {
            echo "<div class='alert alert-success' role='alert'>Proveedor agregado correctamente.</div>";
            header("Location: /admin/proveedores.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al agregar el proveedor.</div>";
        }
    }
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Nuevo Proveedor</h2>
        <form  method="post" id="form"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre<span class="required">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="255">
                <div class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="imagen" name="logo">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Añadir Proveedor</button>
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