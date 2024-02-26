<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
$errores = array();
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
        $errores[] = "No se digitó el nombre del usuario";
    }
    if (empty($apellido)) {
        $errores[] = "No se digitó el apellido del usuario";
    }
    if (empty($correo)) {
        $errores[] = "No se digitó el correo del usuario";
    }

    if (empty($telefono)) {
        $errores[] = "No se digitó el telefono del usuario";
        
    }
    if(strlen($telefono) < 8){
        $errores[] = "El número de teléfono debe tener al menos 8 caracteres.";
    }
    if (empty($password)) {
        $errores[] = "No se digitó la contraseña del usuario";
    }
    if (empty($passwordConfirm)) {
        $errores[] = "No se digitó la contraseña de confirmación del usuario";
    }
    if ($password !== $passwordConfirm) {
        $errores[] = "Las contraseñas no coinciden";
    }
    if(!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/', $password)){
        $errores[] = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un caracter especial.";
    }
    if (empty($errores)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        require_once "DAL/usuariosCrud.php";
        if (registrarUsuario($nombre, $apellido, $correo, $telefono, $passwordHash, $rol));
        header("Location: registroExitoso.php");
    } else {
        error_log("Ah ocurrido un error al registrar el usuario en la base de datos");
    }
}
?>
<main>
    <div class="banner">
        <h1>Registro</h1>
    </div>
    <ul>
        <?php
        foreach ($errores as $error) : ?>
        <li class='error' style="color: red;"><?php echo $error; ?></li>
        <?php
        endforeach;
        ?>
    </ul>

    <div>
        <h2>Crea una cuenta</h2>
        <p>No tienes una cuenta? Aquí puedes crearla</p>
        <form method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
            <label for="correo">Correo Electronico</label>
            <input type="email" name="correo">
            <label for="Telefono">Telefono</label>
            <input type="text" name="telefono">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <label for="password2">Confirmar Contraseña</label>
            <input type="password" name="password2">
            <input hidden type="number" name="rol" value="2">
            <button type="submit">
                INICIAR SESION
            </button>
        </form>
        <p>Ya tienes una Cuenta? Inicia Sesion <span><a href="login.php">Aqui</a></span></p>
    </div>

</main>
<?php
include_once "include/templates/footer.php";
?>

</html>