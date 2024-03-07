
<?php

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
        if (actualizarUsuario($nombre, $apellido, $correo, $telefono, $rol, $idUser)) {
            header("Location: /admin/usuarios.php?ingreso=1");
        } else {
            $errores[] = "Ocurrió un error al actualizar el dato a base de datos";
        }
    }
}
    include_once "../../include/templates/header.php";
?>
<main class="container mt-4">
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
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo isset($apellido) ? $apellido : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?php echo isset($correo) ? $correo : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" name="rol">
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
                      
                        ?>
                        <option value="">No hay roles disponibles</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary color-boton mb-2">Actualizar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";
?>
