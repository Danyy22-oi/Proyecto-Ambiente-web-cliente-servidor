
<?php

$errores = array();
$nombre = $apellido = $correo = $telefono = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "include/functions/recoge.php";
    $nombre = recogePost("nombre");
    $apellido = recogePost("apellido");
    $correo = recogePost("correo");
    $telefono = recogePost("telefono");
    $password = recogePost("password");
    $passwordConfirm = recogePost("password2");
    $rol = recogePost("rol");
    //SANITIZAR DATOS
    $nombre = filter_var($nombre, FILTER_SANITIZE_SPECIAL_CHARS);
    $apellido = filter_var($apellido, FILTER_SANITIZE_SPECIAL_CHARS);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    $telefono = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    $passwordConfirm = filter_var($passwordConfirm, FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($nombre)) {
        $errores['nombre'] = "No se digitó el nombre del usuario";
    }
    if (empty($apellido)) {
        $errores['apellido'] = "No se digitó el apellido del usuario";
    }
    if (empty($correo)) {
        $errores['correo'] = "No se digitó el correo del usuario";
    }
    if (empty($telefono)) {
        $errores['telefono'] = "No se digitó el telefono del usuario";
    }
    if (strlen($telefono) < 8) {
        $errores['telefono'] = "El número de teléfono debe tener al menos 8 caracteres.";
    }
    if (empty($password)) {
        $errores['password'] = "No se digitó la contraseña del usuario";
    }
    if (empty($passwordConfirm)) {
        $errores['password2'] = "No se digitó la contraseña de confirmación del usuario";
    }
    if ($password !== $passwordConfirm) {
        $errores['password2'] = "Las contraseñas no coinciden";
    }
    if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/', $password)) {
        $errores['password'] = "La contraseña debe tener al menos 8 caracteres, una mayúscula y uno de los siguientes caracteres especiales: !@#$%^&*";
    }

    if (empty($errores)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        require_once "DAL/usuariosCrud.php";
        if (registrarUsuario($nombre, $apellido, $correo, $telefono, $passwordHash, $rol)) {
            header("Location: login.php");
            exit;
        }
    } else {
        error_log("A ocurrido un error al registrar el usuario en la base de datos");
    }
}

include_once "include/templates/header.php";
?>
<main>
    <div class="banner">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div>
                    <h1 class="text-center colorPrincipal">Registro</h1>
                    <h2 class="text-center">Crea una cuenta</h2>
                    <p class="text-center">No tienes una cuenta? Aquí puedes crearla</p>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control form-control-sm <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($nombre); ?>" />
                            <?php if (isset($errores['nombre'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="apellido">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control form-control-sm <?php echo isset($errores['apellido']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($apellido); ?>" />
                            <?php if (isset($errores['apellido'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['apellido']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="correo">Email address</label>
                            <input type="email" id="correo" name="correo" class="form-control form-control-sm <?php echo isset($errores['correo']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($correo); ?>" />
                            <?php if (isset($errores['correo'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['correo']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="telefono">Telefono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control form-control-sm <?php echo isset($errores['telefono']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($telefono); ?>" />
                            <?php if (isset($errores['telefono'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['telefono']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm <?php echo isset($errores['password']) ? 'is-invalid' : ''; ?>" />
                            <?php if (isset($errores['password'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['password']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="password2">Confirmar Contraseña</label>
                            <input type="password" id="password2" name="password2" class="form-control form-control-sm <?php echo isset($errores['password2']) ? 'is-invalid' : ''; ?>" />
                            <?php if (isset($errores['password2'])) : ?>
                                <div class="invalid-feedback"><?php echo $errores['password2']; ?></div>
                            <?php endif; ?>
                        </div>
                        <input hidden type="number" name="rol" value="2">
                        <div class="text-center mb-2">
                            <button type="submit" class="btn btnInicio-Registro btn-block ">Registrarse</button>
                        </div>
                    </form>
                    <p class="text-center">Ya tienes una Cuenta? Inicia Sesión <span><a href="login.php">aquí</a></span></p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once "include/templates/footer.php";
?>
