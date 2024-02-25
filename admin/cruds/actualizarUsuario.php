<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";
$errores = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once "../../include/functions/recoge.php";
    $id = recogeGET("id");
    require_once "../../DAL/usuariosCrud.php";
    $query = "SELECT id_usuario, nombre, apellido, correo, id_rol, telefono FROM usuario WHERE id_usuario = $id";
    $queryRol = "SELECT * FROM rol";
    $roles = getArray($queryRol);
 
    $mySession = getObject($query);
    if ($mySession != null) {
        $id = $mySession['id_usuario'];
        $nombre = $mySession['nombre'];
        $apellido = $mySession['apellido'];
        $correo = $mySession['correo'];
        $telefono = $mySession['telefono'];
        $rol = $mySession['id_rol'];
    } else {
        $errores[] = "Usuario no se puede editar porque no existe";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../include/functions/recoge.php";
    $nombre = recogePost("nombre");
    $apellido = recogePost("apellido");
    $correo = recogePost("correo");
    $telefono = recogePost("telefono");
    $rol = recogePost("rol");
    $idUser = recogePost("id");
    //Sanitizar los datos
    $nombre = filter_var($nombre, FILTER_SANITIZE_SPECIAL_CHARS);
    $apellido = filter_var($apellido, FILTER_SANITIZE_SPECIAL_CHARS);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    if (empty($nombre)) {
        $errores[] = "No se digitó el nombre del usuario";
    }
    if (empty($correo)) {
        $errores[] = "No se digitó el correo del usuario";
    }
    if (empty($rol)) {
        $errores[] = "No se seleccionó rol";
    }

    if (empty($errores)) {
        require_once "../../DAL/usuariosCrud.php";
        if (actualizarUsuario($nombre, $apellido, $correo, $telefono, $rol,$idUser)) {
            header("Location: /admin/usuarios.php?ingreso=1");
        } else {
            $errores[] = "Ocurrió un error al actualizar el dato a base de datos";
        }
    }
}

?>
<main>
    <h1>Actualizar Usuario</h1>
    <div>
        <ul>
            <?php
            foreach ($errores as $error) {
                echo "<li class='error'>$error</li>";
            }
            ?>
        </ul>
        <form method="POST">
            <input type="text" name="id" value="<?= $id ?>" hidden>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" value="<?php echo isset($apellido) ? $apellido : ''; ?>" />
            <label for="correo">Correo</label>
            <input type="text" name="correo" value="<?php echo isset($correo) ? $correo : ''; ?>" />
            <label for="rol">Rol</label>
            <select name="rol">
                <?php
                if ($roles) {
                    foreach ($roles as $rol_item) {
                ?>
                        <option value="<?php echo $rol_item['id_rol']; ?>" <?php echo ($rol_item['id_rol'] == $rol) ? 'selected' : ''; ?>>
                            <?php echo $rol_item['nombre_rol']; ?>
                        </option>
                    <?php
                    }
                } else {
                    // Si no se obtuvieron roles, mostrar un mensaje de error
                    ?>
                    <option value="">No hay roles disponibles</option>
                <?php
                }
                ?>
            </select>
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            <button type="submit">Actualizar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";
?>

</html>