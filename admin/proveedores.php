<?php
include_once "../include/functions/autenticado.php";
include_once "../include/functions/autenticado.php";

$auth = estaAutenticado();
if(!$auth){
    header('Location: /');
}

$authAdmin = estaAutenticadoAdmin();
if(!$authAdmin){
    header('Location: /');
}

require_once "../DAL/proveedoresCrud.php";

$elSQL = "SELECT * FROM proveedores";
$proveedores = getArray($elSQL);
$errores = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'eliminar_proveedores') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (EliminarProveedores($id)) {
                header("Location: proveedores.php");
            } else {
                $errores[] = "Error al eliminar el proveedor, producto relacionado";
            }
        } else {
            $errores[] = "ID de proveedor no recibido";
        }
    }
}
include_once '../include/templates/header.php';
?>

<main>
    <div class="container">
        <div style="float: right;">
            <a href="../agregarproveedor.php">
                <button type="button" class="btn btn-success color-boton">Añadir Proveedor</button>
            </a>
        </div>
        <h2>Proveedores</h2>
        <?php foreach ($errores as $error) : ?>
            <div class='alert alert-danger' role='alert'><?php echo $error ?>.</div>
        <?php endforeach; ?>
        <table class="table">
            <thead>
                <tr>
                    <th class="max">Nombre</th>
                    <th>Logo</th>
                    <th>Acciones</th>
                </tr>
                <?php if (!empty($proveedores)) { ?>

            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor) { ?>
                    <tr>
                        <td><?= $proveedor['Nombre'] ?></td>
                        <?php echo "<td><img class='logo' src='../img/proovedores/" . $proveedor['Logo'] . "'></td>"; ?>
                        <td>

                            <a href="../actualizarproveedores.php?id=<?= $proveedor['Id_Proveedor'] ?>" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $proveedor['Id_Proveedor'] ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este proveedor?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <input type="hidden" name="action" value="eliminar_proveedores">
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

    <?php
                }
    ?>

    </div>
</main>

<?php
include_once '../include/templates/footer.php';
?>

</html>