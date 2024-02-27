<?php
include_once 'include/templates/header.php';
require_once "DAL/proveedoresCrud.php";

$proveedores = getArray("SELECT * FROM proveedores");

if($_SERVER['REQUEST_METHOD']== 'GET'){
    require_once "include/functions/recoge.php";
    $id= recogeGet("id");

    $query = "select Id_Proveedor, Nombre, Logo from proveedores where Id_Proveedor = '$id'";
    $mySession = getObject($query);

    if($mySession != null){
            $id = $mySession['Id_Proveedor'];
            $nombre = $mySession['Nombre'];
            $logo = $mySession['Logo'];
        }else{
            
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "include/functions/recoge.php";
        $id= recogePost("Id_Proveedor");
        $nombre = recogePost("nombre");
        $logo = recogePost("logo");

    if (EditarProveedores($id, $nombre, $logo)) {
        header("Location: proveedores.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar el proveedor.</div>";
    }
}
?>

<main>
    <div class="container">
        <h2>Nuevo Proveedor</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <input type="hidden" name="Id_Proveedor" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" maxlength="255"
                    value="<?= $nombre ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="logo">Logo</label>
                <textarea class="form-control" id="Logo" name="logo" rows="2"
                    maxlength="255"><?= $logo ?></textarea>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Proveedor</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>

</html>